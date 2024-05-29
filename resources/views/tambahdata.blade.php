@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-center align-item" style="margin-top:80px">
    <body>
        <h1 class="text-center mb-4">Tambah Data Pegawai</h1>
        <div class="container">
            <div class="row justify-content-center"> 
                <div class="col-8 ">
                    <div class="card">
                        <div class="card-body">
                            <form action="/insertdata" method="POST" enctype="multipart/form-data">
                                @csrf 
                                {{-- wajib kalau mau insert data  --}}
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama lengkap</label>
                                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jeniskelamin" aria-label="Default select example">
                                        <option selected>Pilih jenis kelamin</option>
                                        <option value="cowo">Cowo</option>
                                        <option value="cewe">Cewe</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nomor Telp</label>
                                    <input type="number" name="notelpon" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Masukkan foto</label>
                                    <input type="file" name="foto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</div>

