@extends('layouts.app')

@section('content')

@push('css')
<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>
   span.select2.select2-container.select2-container--classic {
      width: 100% !important;
   }
</style>
<!-- DataTable simple CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.min.css">

<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endpush

<section>
   <div class="container py-4">
      <div class="row">
         <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
            <div class="card d-flex justify-content-center p-4 shadow-lg">
               <div class="text-center">
                  <h3 class="text-gradient text-primary">Formulir Cuti Tahunan</h3>
               </div>
               <div class="card card-plain">
                  <form role="form" action="{{ route('store.cuti') }}" method="post">
                     @csrf
                     <div class="card-body pb-2">
                        <div class="form-group mb-3 mt-md-0 mt-4">
                           <label>Pilih karyawan :</label>
                           <select name="" class="form-select search" id="employee_id"></select>
                        </div>
                        <div class="form-group mb-3 mt-md-0 mt-4">
                           <label>Nama</label>
                           <input class="form-control" id="nama_karyawan" readonly></input>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>NIK</label>
                              <div class="input-group mb-3">
                                 <input name="nik" type="number" class="form-control nik_karyawan" readonly>
                              </div>
                           </div>
                           <div class="col-md-6 ps-md-2 mb-3">
                              <label>Tanggal pengajuan</label>
                              <div class="input-group">
                                 <input name="tanggal_pengajuan" type="date" class="form-control" required>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Departemen</label>
                              <div class="input-group mb-3">
                                 <input class="form-control" type="text" id="departemen" readonly>
                              </div>
                           </div>
                           <div class="col-md-6 ps-md-2 mb-3">
                              <label>Divisi</label>
                              <div class="input-group">
                                 <input type="text" class="form-control" id="divisi" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Cuti Tahunan</label>
                              <div class="input-group mb-3">
                                 <input class="form-control" name="sisa_cuti" type="text" id="sisa_cuti" readonly>
                              </div>
                           </div>
                           <div class="col-md-6 ps-md-2 mb-3">
                              <label>Cuti Covid</label>
                              <div class="input-group">
                                 <input type="text" name="sisa_cuti_covid" class="form-control" id="sisa_cuti_covid" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Mulai cuti</label>
                              <div class="input-group mb-3">
                                 <input class="form-control" name="tgl_mulai_cuti" id="tgl_mulai_cuti" type="date" required>
                              </div>
                           </div>
                           <div class="col-md-6 ps-md-2 mb-3">
                              <label>Selesai cuti</label>
                              <div class="input-group">
                                 <input class="form-control" name="tgl_akhir_cuti" id="tgl_akhir_cuti" type="date" required>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <div class="form-check">
                                 <input class="form-check-input" type="radio" name="kategori_cuti" value="1" id="kategori_cuti_tahunan">
                                 <label class="form-check-label">
                                    Cuti Tahunan
                                 </label>
                              </div>
                           </div>
                           <div class="col-md-6 mb-3">
                              <div class="form-check">
                                 <input class="form-check-input" type="radio" name="kategori_cuti" value="2" id="kategori_cuti_covid">
                                 <label class="form-check-label">
                                    Cuti Covid
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group mb-3 mt-md-0 mt-4">
                           <label>Jumlah hari</label>
                           <input class="form-control" type="text" id="jumlah_hari_cuti" readonly>
                        </div>
                        <div class="form-group mb-3 mt-md-0 mt-4">
                           <label>Keterangan</label>
                           <textarea name="keterangan" class="form-control" id="message" rows="6"></textarea>
                        </div>
                        <div class="row">
                           <div class="col-md-12 text-center">
                              <button type="submit" class="btn bg-gradient-primary mt-3 mb-0" id="submit_button">Kirim</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="my-5 py-5">
   <div class="container">
      <div class="row">
         <div class="row justify-content-center text-center my-sm-5">
            <div class="col-lg-6">
               <h2 class="text-dark mb-0">Bagian Manajemen Aplikasi</h2>
               <h2 class="text-primary text-gradient">Kombinasi tak terbatas</h2>
               <p class="lead">Opsi untuk Kamu kumpulkan dan sesuaikan. </p>
            </div>
         </div>
      </div>
   </div>
   <div class="container mt-sm-5 mt-3">
      <div class="row">
         <div class="col-lg-3">
            <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
               <h3>Pengguna</h3>
               <h6 class="text-secondary font-weight-normal pe-3">Pembuataan akun pengguna serta melakukan perubahan dan menghapus akun</h6>
            </div>
         </div>
         <div class="col-lg-9">
            <div class="row mt-3">
               <!-- Buttons color -->
               <div class="col-12">
                  <div class="position-relative border-radius-xl overflow-hidden shadow-lg mb-7">
                     <div class="container border-bottom">
                        <div class="row justify-space-between py-2">
                           <div class="col-lg-3 me-auto">
                              <p class="lead text-dark pt-1 mb-0">Tabel Pengguna</p>
                           </div>
                           <a data-bs-toggle="modal" data-bs-target="#createUserModal" class="btn btn-primary w-auto me-1 mb-3 mt-2 float-end">Buat</a>
                           <div class="table-responsive">
                              <table class="table align-middle dataTable mb-3">
                                 <thead>
                                    <tr>
                                       <th>Nama</th>
                                       <th>Email</th>
                                       <th width="50px">Aksi</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                       <td>{{ $user->name }}</td>
                                       <td>{{ $user->email }}</td>
                                       <td>
                                          <a data-bs-toggle="modal" data-bs-target="#editUserModal{{$user->id}}" class="btn btn-warning w-auto me-1 mb-0">Edit</a>
                                          <a data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$user->id}}" class="btn btn-danger w-auto me-1 mb-0">Hapus</a>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="tab-content tab-space">
                        <div class="tab-pane active" id="preview-btn-color">
                        </div>
                        <div class="tab-pane" id="code-btn-color">
                           <div class="position-relative p-4 pb-2">
                              <a class="btn btn-sm bg-gradient-dark position-absolute end-4 mt-3" onclick="copyCode(this);" type="button"><i class="fas fa-copy text-sm me-1"></i> Copy</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Edit user account modal -->
<div class="modal fade" id="editUserAccount{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="{{ route('user.store') }}" role="form" method="post" autocomplete="off">
            @csrf
            <div class="modal-body">
               <div class="card-body pb-2">
                  <div class="row">
                     <div class="col-md-6">
                        <label>Nama</label>
                        <div class="input-group mb-4">
                           <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">
                        </div>
                     </div>
                     <div class="col-md-6 ps-md-2">
                        <label>Email</label>
                        <div class="input-group">
                           <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label>Kata Sandi</label>
                        <div class="input-group mb-4">
                           <input class="form-control" name="password" type="password">
                        </div>
                     </div>
                     <div class="col-md-6 ps-md-2">
                        <label>Konfirmasi Kata Sandi</label>
                        <div class="input-group">
                           <input type="password" name="confirmed" class="form-control">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Tutup</button>
               <button type="submit" class="btn bg-gradient-primary">simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Create user modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="{{ route('user.store') }}" role="form" method="post" autocomplete="off">
            @csrf
            <div class="modal-body">
               <div class="card-body pb-2">
                  <div class="row">
                     <div class="col-md-6">
                        <label>Nama</label>
                        <div class="input-group mb-4">
                           <input class="form-control" type="text" name="name" autofocus autocomplete="name">
                        </div>
                     </div>
                     <div class="col-md-6 ps-md-2">
                        <label>Email</label>
                        <div class="input-group">
                           <input type="email" class="form-control" name="email">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label>Kata Sandi</label>
                        <div class="input-group mb-4">
                           <input class="form-control" name="password" type="password">
                        </div>
                     </div>
                     <div class="col-md-6 ps-md-2">
                        <label>Konfirmasi Kata Sandi</label>
                        <div class="input-group">
                           <input type="password" name="confirmed" class="form-control">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Tutup</button>
               <button type="submit" class="btn bg-gradient-primary">simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Edit user modal -->
@foreach($users as $user)
<div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="{{ route('user.update', $user->id) }}" role="form" method="post" autocomplete="off">
            @csrf
            {{ method_field('patch') }}
            <div class="modal-body">
               <div class="card-body pb-2">
                  <div class="row">
                     <div class="col-md-6">
                        <label>Nama</label>
                        <div class="input-group mb-4">
                           <input class="form-control" type="text" name="name" autofocus autocomplete="name" value="{{$user->name}}">
                        </div>
                     </div>
                     <div class="col-md-6 ps-md-2">
                        <label>Email</label>
                        <div class="input-group">
                           <input type="email" class="form-control" name="email" value="{{$user->email}}">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label>Kata Sandi</label>
                        <div class="input-group mb-4">
                           <input class="form-control" name="password" type="password">
                        </div>
                     </div>
                     <div class="col-md-6 ps-md-2">
                        <label>Konfirmasi Kata Sandi</label>
                        <div class="input-group">
                           <input type="password" name="confirmed" class="form-control">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Tutup</button>
               <button type="submit" class="btn bg-gradient-primary">simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endforeach

<!-- Delete user modal -->
@foreach($users as $user)
<div class="modal fade" id="deleteUserModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="{{ route('user.destroy', $user->id) }}" role="form" method="post" autocomplete="off">
            @csrf
            {{ method_field('delete') }}
            <div class="modal-body">
               Kamu yakin ingin menghapus pengguna ini ? <br>
               [ <b>{{ $user->name }}</b> ]
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Tutup</button>
               <button type="submit" class="btn bg-gradient-primary">simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endforeach

@push('scripts')
<script>
   function calculateDays() {
      const startDate = document.getElementById('tgl_mulai_cuti').value;
      const endDate = document.getElementById('tgl_akhir_cuti').value;
      const jumlahHariCuti = document.getElementById('jumlah_hari_cuti');
      const submitButton = document.getElementById('submit_button');
      const sisaCuti = parseInt(document.getElementById('sisa_cuti').value, 10);
      const sisaCutiCovid = parseInt(document.getElementById('sisa_cuti_covid').value, 10);
      const kategoriCutiTahunan = document.getElementById('kategori_cuti_tahunan').checked;
      const kategoriCutiCovid = document.getElementById('kategori_cuti_covid').checked;

      if (startDate && endDate) {
         const start = new Date(startDate);
         const end = new Date(endDate);

         // Calculate the difference in milliseconds
         const differenceInTime = end - start;

         // Calculate the difference in days
         const differenceInDays = Math.ceil(differenceInTime / (1000 * 3600 * 24)) + 1;

         jumlahHariCuti.value = differenceInDays;

         if ((kategoriCutiTahunan && differenceInDays > sisaCuti) ||
            (kategoriCutiCovid && differenceInDays > sisaCutiCovid)) {
            submitButton.disabled = true;
            submitButton.textContent = "Tidak Memenuhi Syarat";
         } else {
            submitButton.disabled = false;
            submitButton.textContent = "Kirim";
         }
      }
   }

   document.getElementById('tgl_mulai_cuti').addEventListener('change', calculateDays);
   document.getElementById('tgl_akhir_cuti').addEventListener('change', calculateDays);
   document.querySelectorAll('input[name="kategori_cuti"]').forEach(function(radio) {
      radio.addEventListener('change', calculateDays);
   });
</script>

<!-- Datatable simple CDN -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.min.js"></script>
<script>
   let table = new DataTable('.dataTable');
</script>
<!-- Select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
   $('.search').select2({
      width: 'resolve',
      theme: 'classic',
      placeholder: 'Cari karyawan...',
      ajax: {
         url: '/api/employee',
         dataType: 'json',
         delay: 250,
         processResults: function(data) {
            return {
               results: $.map(data, function(item) {
                  return {
                     text: item.nik + ' - ' + item.nama_karyawan,
                     id: item.nik
                  }
               })
            };
         },
         cache: true
      }
   });

   $('#employee_id').on('change', function() {
      var id = $(this).val();
      if (id) {
         $.ajax({
            url: '/api/employee/' + id,
            type: "GET",
            data: {
               "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
               if (data) {
                  $('.nik_karyawan').val(data.nik);
                  $('#nama_karyawan').val(data.nama_karyawan);
                  $('#departemen').val(data.departemen);
                  $('#divisi').val(data.nama_divisi);
                  $('#posisi').val(data.posisi);
                  $('#jabatan').val(data.jabatan);
                  $('#sisa_cuti').val(data.sisa_cuti);
                  $('#sisa_cuti_covid').val(data.sisa_cuti_covid);
               }
            }
         });
      }
   });
</script>
@endpush

@endsection