@extends('layouts.main-admin')

@section('content')

<div class="container mr-5 mx-5">

    <h2 class="mt-2 fw-bold mb-5">STATISTIK DATA</h2>

    <?php $jumlah_bem = 2 ?>
    <?php $jumlah_departemen = 7 ?>
    <?php $jumlah_divisi = 29 ?>

    <div class="mb-5">
        <div class="d-flex justify-content-start">
            <a href="/manajemen/bem">
                <div class="box mx-4" style="background-color:#00D1B8; padding: 30px; padding-left: 80px; padding-right: 80px; border-radius: 10px; font-size: 2em; color: white; font-weight: bold; text-align: center">
                    {{$jumlah_bem}} <br>
                    <span style="font-size: 0.7em;">Jumlah BEM</span>
                </div>
            </a>

            <a href="/manajemen/departemen">
                <div class="box mx-4" style="background-color: #32A9FF ; padding: 30px; padding-left: 35px; padding-right: 35px; border-radius: 10px; font-size: 2em; color: white; font-weight: bold; text-align: center">
                    {{$jumlah_departemen}} <br>
                    <span style="font-size: 0.7em;">Jumlah Departemen</span>
                </div>
            </a>

            <a href="/manajemen/divisi">
                <div class="box mx-4" style="background-color: #947AFF; padding: 30px; padding-left: 80px; padding-right: 80px; border-radius: 10px; font-size: 2em; color: white; font-weight: bold; text-align: center">
                    {{$jumlah_divisi}} <br>
                    <span style="font-size: 0.7em;">Jumlah Divisi</span>
                </div>
            </a>

        </div>
    </div>

</div>



@endsection