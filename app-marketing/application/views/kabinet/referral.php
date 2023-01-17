 <!-- BEGIN: Subheader -->
 <!--  <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Dashboard</h3>
            </div>
           
        </div>
    </div> -->

 <!-- END: Subheader -->
 <div class="m-subheader ">

     <div class="row ui-sortable" id="m_sortable_portlets">
         <div class="col-lg">
             <!--begin::Section-->
             <div class="m-content">
                 <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                     <div class="m-alert__icon">
                         <i class="flaticon-exclamation m--font-brand"></i>
                     </div>
                     <div class="m-alert__text">
                         Tabel dibawah ini adalah nasabah yang sudah berhasil di ajak join di kabinet PT. Tifia Finansial Berjangka, perhitungan komisi nya tergantung dari transaksi <strong>LOT</strong> nasabah anda, perhitungan komisi akan dilakukan setiap tanggal 28 dan akan di bagikan dari tanggal 1 s/d tanggal 5
                     </div>
                 </div>

                 <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                     <div class="m-alert__icon">
                     </div>
                     <div class="m-alert__text">
                         <table class="table">
                             <h6>Link Referral Anda : https://my.tfx.co.id/client/?referral=1010101</h6>
                             <thead class="thead-inverse">
                                 <tr>
                                     <td><strong>Referral Aktif</strong></td>
                                     <th><strong>Referral Proses</strong></th>
                                     <th><strong>Total Komisi Aktif</strong></th>
                                     <th><strong>Total Komisi Aktif Telah Dibayar</strong></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td>2</td>
                                     <td>2</td>
                                     <td>Rp.230.000,-</td>
                                     <td>Rp.230.000,-</td>
                                 </tr>

                             </tbody>
                         </table>
                     </div>
                 </div>
                 <!-- tabel referral & klaim komisi -->
                 <div class="m-portlet m-portlet--mobile">
                     <div class="m-portlet__head">
                         <div class="m-portlet__head-caption">
                             <div class="m-portlet__head-title">
                                 <h3 class="m-portlet__head-text">
                                     Daftar Referral dan Komisi Anda
                                 </h3>
                             </div>
                         </div>
                     </div>
                     <div class="m-portlet__body">

                         <!--begin: Datatable -->
                         <table class="table table-striped- table-bordered table-hove" id="m_table_1">
                             <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Tanggal</th>
                                     <th>Nama Nasabah</th>
                                     <th>Email</th>
                                     <th>Handphone</th>
                                     <th>LOT</th>
                                     <th>Komisi</th>
                                     <th>Action</th>
                                     <th>Status</th>
                                     <th>Actions</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td>1</td>
                                     <td>25-06-2017</td>
                                     <td>Elmiranto</td>
                                     <td>nasabah@gmail.com</td>
                                     <td>081289128392</td>
                                     <td>21</td>
                                     <td>230.000</td>
                                     <td><button type="button" class="btn btn-info btn-sm">Ambil</button></td>
                                     <td>2</td>
                                     <td nowrap></td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 </div>
                 <!-- tabel referral & klaim komisi -->



                 <!-- penrikan dana komisi -->
                 <div class="row">
                     <div class="col-lg-12">

                         <!--begin::Portlet-->
                         <div class="m-portlet">
                             <div class="m-portlet__head">
                                 <div class="m-portlet__head-caption">
                                     <div class="m-portlet__head-title">
                                         <span class="m-portlet__head-icon m--hide">
                                             <i class="la la-gear"></i>
                                         </span>
                                         <h3 class="m-portlet__head-text">
                                             Penarikan Dana Komisi Referral
                                         </h3>
                                     </div>
                                 </div>
                             </div>

                             <!--begin::Form-->
                             <form class="m-form m-form--label-align-right">
                                 <div class="m-portlet__body">
                                     <div class="m-form__section m-form__section--first">
                                         <div class="m-form__heading">
                                         </div>
                                         <div class="form-group m-form__group row">
                                             <label class="col-lg-2 col-form-label">Jumlah Komisi IDR</label>
                                             <div class="col-lg-6">
                                                 <input type="email" class="form-control m-input" placeholder="230.000" disabled="">
                                                 <span class="m-form__help">Nominal ini yang akan anda dapatkan dari hasil komisi</span>
                                             </div>
                                         </div>

                                     </div>

                                 </div>
                                 <div class="m-portlet__foot m-portlet__foot--fit">
                                     <div class="m-form__actions m-form__actions">
                                         <div class="row">
                                             <div class="col-lg-2"></div>
                                             <div class="col-lg-6">

                                                 <button type="reset" class="btn btn-secondary">Cancel</button>
                                                 <button type="reset" class="btn btn-primary">Submit</button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </form>

                             <!--end::Form-->
                         </div>

                         <!--end::Portlet-->


                     </div>
                 </div>
                 <!-- penarikan dana komisi -->

                 <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                     <div class="m-alert__icon">
                     </div>
                     <div class="m-alert__text">
                         <h6>Status penarikan dana komisi</h6>
                         <table class="table table-striped m-table">
                             <thead>
                                 <tr>
                                     <th>Tanggal</th>
                                     <th>Total Komisi</th>
                                     <th>Status</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td>05-10-2019</td>
                                     <td>Rp.300.000.000</td>
                                     <td>On Proses</td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
             <!--end::Section-->
             <!--  -->

             <!--end::Portlet-->

         </div>
     </div>
 </div>



 <!-- end:: Body -->