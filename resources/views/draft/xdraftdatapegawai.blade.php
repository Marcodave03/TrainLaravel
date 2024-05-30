<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD LARAVEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    {{-- toastr css --}}
  </head>
  <body>
    <h1 class="text-center mb-4">Data Pegawai</h1>
    <div class="container">
        <a href="/tambahpegawai" type="button" class="btn btn-success">Tambah</a>
        <div class="row input-group mb-3 mt-2" >
          <div class="col-auto">
            <form action="/pegawai" method="GET">
              <input type="search" name="search" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </form>
          </div>
          <div class="col-auto">
            <a href="/exportpdf" type="button" class="btn btn-info">Export PDF</a>
          </div>
          <div class="col-auto">
            <a href="/exportexcel" type="button" class="btn btn-success">Export Excel</a>
          </div>
          <div class="col-auto">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Import Data
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/importexcel" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                      <div class="form-group">
                          <input type="file" name="file" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>


        </div>
        <div class="row">
            @if($message=Session::get('success'))
                <div class="alert alert-success mt-4"  role="alert">
                    {{$message}}
                </div>
            @endif
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">no</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Nomor Telp</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                    @php
                        $no=1;
                    @endphp
                    
                    @foreach ($data as $index => $row)
                        <tr>
                            <th scope="row">{{$index + $data->firstItem()}}</th>
                            <th scope="row">{{$row->id}}</th>
                            <td>{{$row->nama}}</td>
                            <td>
                              <img src="{{asset('fotopegawai/'.$row->foto)}}" style="width:40px" alt="">
                            </td>
                            <td>{{$row->jeniskelamin}}</td>
                            <td>{{$row->notelpon}}</td>
                            <td>{{$row->created_at->format('D M Y')}}</td>
                            <td>{{$row->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="/tampilkandata/{{$row->id}}" type="button" class="btn btn-info">Edit</a>
                                <a href="#" type="button" class="btn btn-danger delete" data-id="{{$row->id}}" data-nama="{{$row->nama}}"   >Delete</a>
                            </td>
                            {{-- /delete/{{$row->id}} --}}
                        </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $data->links() }}
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- sweetalert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
  <script>
    $('.delete').click(function(){
      var pegawaiid=$(this).attr('data-id');
      var nama=$(this).attr('data-nama');
      swal({
        title: "Yakin ?",
        text: "Kamu akan menghapus data pegawai dengan nama "+nama+" "+"dengan id "+pegawaiid,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/delete/"+pegawaiid+""
          swal("Data berhasil dihapus!", {
            icon: "success",
          });
        } else {
          swal("Data tidak jadi dihapus!");
        }
      });
    });
    
  </script>

  <script>
    @if(Session::has('success'))
      toastr.success("{{Session::get('success')}}")
    @endif
  </script>
</html>