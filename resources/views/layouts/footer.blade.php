<footer>
    <div class="footer-content">
        <h3>NeoSOFT Developer</h3>
        <p>Developed and maintained by Sunil Thakur</p>
    </div>
    <div class="footer-bottom">
        <p>copyright &copy; <span id="year"> </span> <a href="#">NeoSOFT Developer</a> </p>
    </div>
</footer>

<script>
    let year = document.querySelector("#year");

    $(document).ready(function () {
        year.innerText = new Date().getFullYear();
    });
</script>