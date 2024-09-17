<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .center{
            text-align: center;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: beige;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="center">
    <form action="" method="post">
    <label for="jumlah">Masukan Jumlah Liter : </label>
            <input type="number" name="jumlah" id="jumlah" placeholder="Isi berapa liter" required>
            <br>
            <label for="jenis">Pilih Jenis Bahan Bakar : </label>
            <select name="jenis" id="jenis">
                <option value="" selected hidden desabled>Pilih bahan bakar</option>
                <option value="Shell Super">Shell Super</option>                    
                <option value="Shell V-Power">Shell V-Power</option>
                <option value="Shell V-Power Diesel">Shell V-Power Diesel</option>
                <option value="Shell V-Power Nitro">Shell V-Power Nitro</option>
            </select>
            <br>
            <input type="submit" name="submit" value="Beli" required>
            <input type="button" name="reset" value="reset" onClick="window.location.href=window.location.href">
        </form>
    </div>
</body>
</html>
<?php
    class bensin{
        public $harga;
        public $jumlah;
        public $jenis;
        public $ppn;

        public function __construct($harga,$jenis){
            $this->harga = $harga;
            $this->jumlah = 0;
            $this->jenis = $jenis;
            $this->ppn = 0.1;
        }

        public function totalHarga(){
            $total = $this->harga * $this->jumlah;
            $totalPpn = $total * $this->ppn;
            return $total + $totalPpn;
        }
    }
    class bayar extends bensin{
        public function __construct($harga, $jenis, $jumlah){
            parent::__construct($harga, $jenis);
            
            $this->jumlah = $jumlah;
        }
        public function bukti(){
            $pajak = $this->harga * $this->jumlah * $this->ppn;
            $total = $this->totalHarga();
            return "<center>"."Bahan bakar yang di beli berjenis $this->jenis"."<br>Jumlah liter : $this->jumlah"."<br>harga per liter : $this->harga"."<br>dengan pajak (10%) : $pajak "."<br>Harga yang harus dibayarkan : $total";
        }
    }
    if (isset($_POST['submit'])){
        if (isset($_POST['jenis']) && ($_POST['jumlah'])){
            $jenis = $_POST['jenis'];
            $jumlah = $_POST['jumlah'];

            $hargaShellSuper = 15000;
            $hargaShellVPower = 16000;
            $hargaShellVpowerdiesel = 18000;
            $hargaShellVPowerNitro = 19000;

            switch($jenis){
                case 'Shell Super':
                    $harga = $hargaShellSuper;
                    break;
                case 'Shell V-Power':
                    $harga = $hargaShellVPower;
                    break;
                case 'Shell V-Power Diesel':
                    $harga = $hargaShellVpowerdiesel;
                    break;
                case 'Shell V-Power Nitro':
                    $harga = $hargaShellVPowerNitro;
                    break;
                default:
                    $harga = 0;
            }
        } elseif (isset($_POST['reset']));

        $pembelian = new bayar ($harga, $jenis, $jumlah);
        echo $pembelian->bukti();
    }
?>  