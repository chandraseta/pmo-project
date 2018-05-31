
<footer class="footer">
    <div class="container">
        @if ($nama_pengubah === "Anda")
            <p class="float-right">Terakhir <b>{{$nama_pengubah}}</b> edit
        @else
            <p class="float-right">Terakhir diedit oleh <b>{{$nama_pengubah}}</b>
        @endif
             pada <b>{{$last_edited}}</b> &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-primary"href="#"><i class="fa fa-angle-double-up"></i></a></p>
        <p>Created by pplk2b-2018 for UPT PMO ITB &copy; 2018 &middot; </p>
    </div>
</footer>