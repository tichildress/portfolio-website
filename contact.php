<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact | Tanner Childress</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <img src="/images/TC_Logo.png" alt="Logo">
        <nav class="nav-links">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="projects.html">Projects</a></li>
                <li><a href="contact.html" class="active">Contact</a></li>
            </ul>
        </nav>

        <div class="menu-toggle" id="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <nav class="mobile-menu" id="mobile-menu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="projects.html">Projects</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section id="contact">
        <h2 class="section-title">Get in Touch</h2>

        <?php if (isset($_GET['success'])): ?>
        <p class="form-success">✅ Your message has been sent successfully!</p>
        <?php elseif (isset($_GET['error'])): ?>
        <p class="form-error">❌ Something went wrong. Please try again.</p>
        <?php endif; ?>

        <form class="contact-form" action="send_mail.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </section>


    <footer>
        © <span id="year"></span> Tanner Childress. All Rights Reserved.
    </footer>

    <script src="script.js"></script>
</body>

</html>