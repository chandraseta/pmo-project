<template>
    <nav class="navbar navbar-expand-md bg-primary navbar-dark">
        <a class="navbar-brand font-weight-bold" href="#">UPT PMO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Data Pegawai <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Data Kompetensi </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Data Kinerja</a>
                </li>
            </ul>
            <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
                <a class="btn navbar-btn btn-primary ml-2 text-white"><span class="oi oi-person" title="user icon" aria-hidden="true"></span> Username</a>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
            console.log("Navbar mounted.");
        }
    }
</script>

<style>

</style>