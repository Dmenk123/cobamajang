<table>
    
    <thead>
        <tr>
            <td>Tanggal</td>
            <td>Email</td>
            <td>Kelas</td>
            <td>Pendapatan</td>
            <td>Keterangan</td>
            <td>Saldo Akhir</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tes as $key => $val) { ?>
            <tr>
                <td><?php echo DateTime::createFromFormat('Y-m-d H:i:s', $val->created_at)->format('d/m/Y');?></td>
                <td><?php echo $val->email; ?></td>
                <td><?php echo $val->keterangan; ?></td>
                <td><?php echo 'Penerimaan Dari '.$val->nama; ?></td>
                <td><?php echo "Rp " . number_format($saldo_akhir,0,',','.') ?></td>
            </tr>
		<?php } ?>
    </tbody>

</table>