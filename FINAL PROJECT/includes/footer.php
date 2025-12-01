<?php
// detect current page
$currentPage = basename($_SERVER['PHP_SELF']);

// fullwidth = lahat EXCEPT login.php
$fullWidth = $currentPage !== "login.php";
?>

<footer class="site-footer <?= $fullWidth ? 'fullwidth' : '' ?>">
    <div class="footer-wrapper">

        <div class="footer-col">
            <h4>SUPPORT</h4>
            <a href="#">Help Center</a>
            <a href="#">Contact Us</a>
            <a href="#">FAQs</a>
        </div>

        <div class="footer-col">
            <h4>TOOLS</h4>
            <a href="#">Analytics</a>
            <a href="#">Track Goals</a>
            <a href="#">Budget Planner</a>
        </div>

        <div class="footer-col">
            <h4>COMPANY</h4>
            <a href="#">About</a>
            <a href="#">Careers</a>
            <a href="#">Privacy</a>
        </div>

        <div class="footer-col">
            <h4>CONTACT</h4>
            <p>Saving Goal Tracker</p>
            <p>Philippines</p>
        </div>

    </div>

    <div class="footer-bottom">
        © <?= date("Y") ?> Saving Goal Tracker — All Rights Reserved.<br>
        <span class="designed-by">
            <em>Designed by Vince Jollo Grafel, Akimi Mariel Magpantay, Mikee Dorol, and Juliana Lorriane Guanzon.</em>
        </span>
    </div>
</footer>

<style>
/* Main footer container */
.site-footer {
    background: linear-gradient(135deg,#0f3926,#147b4e,#1a8c55);
    color: white;
    padding: 60px 0 35px;
    margin-top: 80px;
    width: 100%;
    position: relative;
}

/* FULL WIDE MODE (Dashboard only) */
.fullwidth {
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
}

/* Footer content grid */
.footer-wrapper {
    max-width: 1500px;
    width: 100%;
    margin: 0 auto;
    padding: 0 40px;

    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
    gap: 40px;
}

.footer-col h4 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 14px;
}

.footer-col a,
.footer-col p {
    font-size: 0.9rem;
    margin-bottom: 6px;
    opacity: 0.85;
    text-decoration: none;
    display: block;
}

.footer-col a:hover {
    opacity: 1;
}

/* Bottom section */
.footer-bottom {
    text-align: center;
    padding-top: 18px;
    margin-top: 25px;
    border-top: 1px solid rgba(255,255,255,0.3);
    font-size: 0.9rem;
    line-height: 1.5;
}

.designed-by {
    opacity: 0.9;
    font-style: italic;
}
</style>
