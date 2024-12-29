<div class="container my-6">
    <h2>Kết quả học tập</h2>
    <?php if (isset($data['results']) && !empty($data['results'])): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Học kỳ</th>
                    <th>Năm học</th>
                    <th>Điểm</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['results'] as $result): ?>
                    <tr>
                        <td><?php echo $result['MaMon']; ?></td>
                        <td><?php echo $result['TenMon']; ?></td>
                        <td><?php echo $result['HocKy']; ?></td>
                        <td><?php echo $result['NamHoc']; ?></td>
                        <td><?php echo $result['Diem']; ?></td>
                        <td><?php echo $result['TrangThai']  ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Không có kết quả học tập nào.</p>
    <?php endif; ?>
    <?php if (isset($data['average_score'])) { ?>
        <h4>Điểm Trung Bình: <?php echo $data['average_score']; ?></h4>
    <?php } ?>
</div>