<?php
class payment_tuition_m extends connectDB
{
    // Lấy thông tin học phí
    public function getTuitionInfo()
    {
        $query = "SELECT 
            hocphi.MaSoSV, 
            hocphi.HocKy, 
            hocphi.NamHoc,
            SUM(monhoc.SoTinChi) AS TongSoTinChi, 
            SUM(hocphi.SoTien) AS TongSoTien, 
            SUM(hocphi.SoTienDaThanhToan) AS Tongtiendathanhtoan,
            CASE 
                WHEN SUM(CASE WHEN hocphi.TrangThai = 'Chua thanh toan' THEN 1 ELSE 0 END) > 0 THEN 'Chua thanh toan'
                WHEN SUM(CASE WHEN hocphi.SoTienDaThanhToan < hocphi.SoTien THEN 1 ELSE 0 END) > 0 THEN 'Mot phan thanh toan'
                ELSE 'Da thanh toan'
            END AS TrangThai
        FROM hocphi
        JOIN monhoc ON hocphi.MaMon = monhoc.MaMon
        GROUP BY hocphi.MaSoSV, hocphi.HocKy, hocphi.NamHoc";

        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        // Trả về danh sách sinh viên với học phí tổng hợp
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Xử lý thanh toán học phí
    public function submitPayment($MaSoSV, $HocKy, $NamHoc, $SoTienThanhToan)
    {
        // Bước 1: Lấy thông tin các môn học của sinh viên
        $query = "SELECT hocphi.MaMon, hocphi.SoTien, hocphi.SoTienDaThanhToan
                  FROM hocphi 
                  JOIN monhoc ON hocphi.MaMon = monhoc.MaMon 
                  WHERE hocphi.MaSoSV = ? AND hocphi.HocKy = ? AND hocphi.NamHoc = ?";

        $stmt = $this->con->prepare($query);
        $stmt->bind_param("sss", $MaSoSV, $HocKy, $NamHoc);
        $stmt->execute();
        $result = $stmt->get_result();

        // Bước 2: Tính tổng học phí của sinh viên và chuẩn bị dữ liệu
        $totalFee = 0;
        $monHocData = [];
        while ($row = $result->fetch_assoc()) {
            $monHocData[] = $row;
            $totalFee += $row['SoTien'];
        }

        // Nếu không có dữ liệu môn học, dừng quá trình thanh toán
        if (empty($monHocData)) {
            return false; // Hoặc xử lý thông báo lỗi nếu cần
        }

        // Bước 3: Phân bổ số tiền thanh toán cho từng môn học
        $remainingPayment = $SoTienThanhToan;
        $payments = [];

        // Chia tỷ lệ và làm tròn số tiền thanh toán cho mỗi môn học
        foreach ($monHocData as $mon) {
            // Tính tỷ lệ thanh toán cho môn học này
            $paymentForSubject = round(($mon['SoTien'] / $totalFee) * $SoTienThanhToan, 2); // Làm tròn đến 2 chữ số thập phân
            $payments[] = $paymentForSubject;
        }

        // Bước 4: Tính tổng số tiền đã thanh toán
        $totalPaid = array_sum($payments);

        // Bước 5: Tính số dư nếu có (do làm tròn số tiền thanh toán)
        $remainingAmount = $SoTienThanhToan - $totalPaid;

        // Bước 6: Cập nhật số tiền đã thanh toán cho từng môn học
        foreach ($monHocData as $key => $mon) {
            // Cập nhật số tiền thanh toán cho môn học
            $newPayment = $mon['SoTienDaThanhToan'] + $payments[$key];

            // Kiểm tra nếu số tiền thanh toán không vượt quá số tiền học phí của môn học
            if ($newPayment > $mon['SoTien']) {
                $newPayment = $mon['SoTien']; //
            }


            $updateQuery = "UPDATE hocphi 
                            SET SoTienDaThanhToan = ? 
                            WHERE MaSoSV = ? AND MaMon = ? AND HocKy = ? AND NamHoc = ?";
            $stmtUpdate = $this->con->prepare($updateQuery);
            $stmtUpdate->bind_param("dssss", $newPayment, $MaSoSV, $mon['MaMon'], $HocKy, $NamHoc);
            $stmtUpdate->execute();
        }


        if ($remainingAmount <= 0) {

            $status = 'Da thanh toan';
        } else {

            $status = 'Chua thanh toan';
        }


        $updateStatusQuery = "UPDATE hocphi 
                              SET TrangThai = ? 
                              WHERE MaSoSV = ? AND HocKy = ? AND NamHoc = ?";
        $stmtStatus = $this->con->prepare($updateStatusQuery);
        $stmtStatus->bind_param("ssss", $status, $MaSoSV, $HocKy, $NamHoc);
        $stmtStatus->execute();
    }
}
