<footer>

    <base href="/web-project-the-a-team/">

    <!-- <div class="footer-container"> -->

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Site Visitors</h3>
                <ul>
                    <li><a href="../web-project-the-a-team/pages/about-page/">About us</a></li>
                    <li><a href="../web-project-the-a-team/pages/contact-us/">Contact us</a></li>
                    <li><a onclick="localStorage.setItem('selectedProgram', 'all')" href="../web-project-the-a-team/pages/pragram-page/">Programmes</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>For Staffs</h3>
                <ul>

                    <li><a class="admin-link" href="#">Admin</a></li>
                    <li><a class="staff-link" href="#">Staff</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Find Us</h3>
                <p>The University of ,<br> University Road,<br> Leicester,<br> LE1 7RH,<br> United Kingdom.</p>
                <a target="#" href="https://maps.app.goo.gl/XW8YSF2oQrUgCfWd8">Campus map</a>

            </div>
            
            
              
            <div class="footer-column">
            <h3>Follow us</h3>
            <ul>
            <li><i class="fa-brands fa-facebook"></i> @student_course_hub</li>
            <li><i class="fa-brands fa-instagram"></i> @student_course_hub</li>
            <li><i class="fa-brands fa-linkedin"></i> @student_course_hub</li>
            <li><i class="fa-brands fa-x-twitter"></i> @student_course_hub</li>
                </ul>
            </div>
        </div>

        <div class="copyright">Copyright © Student Course Hub 2025. All rights reserved.</div>
    </footer>




    <!-- </div> -->
</footer>



<!-- admin and staff link based on the login session -->
<script>
    // user types constant variables
    const USER_TYPE_ADMIN = 'admin';
    const USER_TYPE_STAFF = 'staff';

    const adminLink = document.querySelector('.admin-link');
    const staffLink = document.querySelector('.staff-link');

    adminLink.addEventListener('click', (e) => {
        e.preventDefault();

        // setting user type while navigating to login page based on link (if clicked staff user type = 'staff' and if admin vice versa)
        localStorage.setItem('userType', USER_TYPE_ADMIN);

        // retriving user cache data from localstorage
        const adminToken = localStorage.getItem('admin');

        if (adminToken === null) {
            window.location.href = "/web-project-the-a-team/pages/admin-login/";
        } else {
            window.location.href = "/web-project-the-a-team/pages/admin/";
        }

    });


    staffLink.addEventListener('click', (e) => {
        e.preventDefault();

        // setting user type while navigating to login page based on link (if clicked staff user type = 'staff' and if admin vice versa)
        localStorage.setItem('userType', USER_TYPE_STAFF);

        // retriving user cache data from localstorage
        const staffToken = localStorage.getItem('staff');

        if (staffToken === null) {
            window.location.href = "/web-project-the-a-team/pages/admin-login/";
        } else {
            window.location.href = "/web-project-the-a-team/pages/staff/";
        }

    });
</script>