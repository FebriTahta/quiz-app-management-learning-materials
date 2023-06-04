<!-- Right Sidebar -->
<aside class="control-sidebar fixed white ">
    <div class="slimScroll">
        <div class="sidebar-header">
            <h4>Activity List</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        
        
        <div class="sidebar-header">
            <h4>Aktifitas Upload Artikel / Berita Terakhir</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        <div class="p-4">
            
            <div class="activity-item activity-primary">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> ---
                    </small>
                    <p>---</p>
                    <p>---</p>
                </div>
            </div>
            
        </div>
    </div>
</aside>
<!-- /.right-sidebar -->
<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
<div class="control-sidebar-bg shadow white fixed" ></div>
</div>
<!--/#app -->
<script src="{{asset('assets/assets/js/app.js')}}"></script>

<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->

<!-- Toast -->
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
{{-- <script src="assets/vendor/toastr/toastr.min.js"></script> <!-- Toastr Plugin Js -->  --}}
<script src="assets/vendor/toastr/toastr.js"></script> <!-- Toastr Plugin Js --> 

<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

@yield('script')

<script>
$(document).ready(function () {
    var today = new Date();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var wrapper = $('#wrapper_notif_admin');
    var pesan = [];
    if (today.getHours() < 15) {
        $.ajax({
        type: 'GET',
        url: '/update-notif-jadwal-admin',
        success: function(response) {
            $('#total_notif').html(response.total);
            $('#head-notif').html('You have '+response.total+' notifications');
            console.log(response.data.length);
            $.each(response.data, function(index, value) {
                $('#notif'+index).remove();
                if (value.status == 'unread') {
                    wrapper.append(
                        '<li class="header" style="background-color: rgb(228, 225, 225)"><a href="'+value.link+'"><i class="icon icon-data_usage text-success"></i>'+value.pesan+'</a></li>'
                    );   
                }else{
                    wrapper.append(
                        '<li class="header"><a href="'+value.link+'"><i class="icon icon-data_usage text-success"></i>'+value.pesan+'</a></li>'
                    );
                }
            })
        }
    });
    }
})
</script>

<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
@vite(['resources/js/app.js'])
</body>
</html>