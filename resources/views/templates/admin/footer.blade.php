<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

@push('js-library')
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('public/assets') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('public/assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('public/assets') }}//vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('public/assets') }}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<!-- <script src="{{ asset('public/assets') }}/vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="{{ asset('public/assets') }}/js/demo/chart-area-demo.js"></script>
<script src="{{ asset('public/assets') }}/js/demo/chart-pie-demo.js"></script> -->

<!-- Page level plugins -->
<script src="{{ asset('public/assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('public/assets') }}/js/demo/datatables-demo.js"></script>
@endpush