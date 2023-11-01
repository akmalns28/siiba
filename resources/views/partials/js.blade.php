  <!-- General JS Scripts -->
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/modules/jquery.min.js"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/modules/popper.js"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/modules/tooltip.js"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/modules/bootstrap/js/bootstrap.js"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/modules/moment.min.js"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/js/stisla.js"></script>


  <!-- JS Libraies -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
      $(document).ready(function() {
          $('.select2').select2();
      });
  </script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/jquery.sparkline.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
      integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script
      src="{{ asset('stisla-1-2.2.0/dist/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}">
  </script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}">
  </script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}">
  </script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/modules/prism/prism.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/js/page/index.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/js/page/forms-advanced-forms.js') }}"></script>
  <script src="{{ asset('/') }}stisla-1-2.2.0/dist/assets/js/page/bootstrap-modal.js"></script>


  <!-- Template JS File -->
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('stisla-1-2.2.0/dist/assets/js/custom.js') }}"></script>
  {{-- sweet alert  --}}
  <script src="{{ asset('js/satuan.js') }}"></script>
  <script src="{{ asset('js/kategori.js') }}"></script>
  <script src="{{ asset('js/ruangan.js') }}"></script>

  <script>
      @if (Session::has('success'))
          toastr.success("{{ session::get('success') }}")
      @endif
  </script>
