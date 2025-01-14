<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Baskerville+SC:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <title>About Us</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Baskerville SC', serif;
    }

    .top-bar {
      background-color: #003300;
      padding: 15px 20px;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .top-bar .title-area h1 a {
      color: #fff;
      text-decoration: none;
      font-size: 2em;
      font-weight: bold;
    }

    .toggle-topbar.menu-icon {
      display: none;
    }

    .top-bar-section ul {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .top-bar-section ul li a {
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      transition: background-color 0.3s;
      border-radius: 5px;
    }

    .top-bar-section ul li a:hover,
    .top-bar-section ul li.active a {
      background-color: #9a1e1e;
    }

    @media only screen and (max-width: 768px) {
      .top-bar .top-bar-section {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 10px;
        background: #333;
        color: #fff;
        border: none;
        position: absolute;
        top: 10px;
        right: 10px;
      }

      .top-bar .toggle-topbar {
        display: block;
      }

      .top-bar .toggle-topbar.menu-icon a {
        display: block;
        padding: 10px;
        color: #fff;
      }

      .top-bar .toggle-topbar.menu-icon a span {
        display: block;
        width: 30px;
        height: 3px;
        background: #fff;
        position: relative;
        transition: background 0.3s ease;
      }

      .top-bar .toggle-topbar.menu-icon a span::before,
      .top-bar .toggle-topbar.menu-icon a span::after {
        content: "";
        display: block;
        width: 30px;
        height: 3px;
        background: #fff;
        position: absolute;
        transition: transform 0.3s ease;
      }

      .top-bar .toggle-topbar.menu-icon a span::before {
        top: -8px;
      }

      .top-bar .toggle-topbar.menu-icon a span::after {
        top: 8px;
      }

      .top-bar .show-menu {
        display: block;
        position: absolute;
        top: 60px;
        right: 0;
        background: #333;
        width: 100%;
        border-top: 1px solid #fff;
      }

      .top-bar .show-menu ul {
        list-style: none;
        padding: 0;
      }

      .top-bar .show-menu ul li {
        border-bottom: 1px solid #444;
        margin: 0;
      }

      .top-bar .show-menu ul li a {
        display: block;
        padding: 10px;
        color: #fff;
        text-decoration: none;
      }

      .top-bar .show-menu ul li a:hover {
        background: #444;
      }
    }

    footer {
      background-color: #003300;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: 20px;
      font-size: 0.9em;
    }

    .mission, .vision, .values {
      margin: 0 auto;
      padding: 20px;
      max-width: 800px;
      text-align: center;
    }

    .mission h3, .vision h3, .values h3 {
      color: #006400;
      margin-bottom: 10px;
    }

    .services {
      text-align: center;
      padding: 2rem;
      background-color: #f9f9f9;
      margin-top: 50px;
    }

    .services h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .services-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
    }

    .service-item {
      flex: 1 1 200px;
      max-width: 300px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
      background-color: #fff;
      text-align: center;
      padding: 1rem;
      margin: 0 auto;
    }

    .service-item img {
      width: 100%;
      height: auto;
      border-bottom: 2px solid #ddd;
    }

    .service-item h3 {
      margin: 1rem 0 0;
      font-size: 1.25rem;
    }

    .about-section {
      margin: 50px auto;
      padding: 40px 20px;
      max-width: 90%;
      text-align: center;
      box-sizing: border-box;
    }

    .about-section .tip {
      font-weight: bold;
      font-size: 24px;
      margin-bottom: 15px;
    }

    .about-section .second-text {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    @media (max-width: 768px) {
      .about-section {
        margin: 50px auto;
        padding: 30px 15px;
        max-width: 95%;
      }

      .about-section .tip {
        font-size: 20px;
        margin-bottom: 10px;
      }

      .about-section .second-text {
        font-size: 14px;
        margin-bottom: 15px;
      }
    }

    @media (max-width: 480px) {
      .about-section {
        margin: 200px auto;
        padding: 20px 10px;
        max-width: 100%;
      }

      .about-section .tip {
        font-size: 18px;
        margin-bottom: 8px;
      }

      .about-section .second-text {
        font-size: 12px;
        margin-bottom: 10px;
      }
    }

    .mission {
      background-color: #ffc4c4;
    }

    .vision {
      background-color: rgb(170, 255, 0);
    }

    .values {
      background-color: #e6e6fa;
    }

    .cards {
      display: flex;
      justify-content: center;
      gap: 20px;
      text-align: center;
      padding: 2rem;
      background-color: #fff;
      margin-top: 500px;
    }

    .card {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      height: 350px;
      width: 1000px;
      max-width: 90vw;
      border-radius: 10px;
      color: rgb(0, 0, 0);
      cursor: pointer;
      transition: 400ms;
      padding: 15px;
      box-sizing: border-box;
      margin: 0 auto;
    }

    .card p.tip {
      font-size: 22px;
      font-weight: bold;
      margin: 0;
    }

    .card p.second-text {
      font-size: 15px;
      margin-top: 10px;
      line-height: 1.5;
    }

    .card:hover {
      transform: scale(1.1, 1.1);
    }

    .cards:hover > .card:not(:hover) {
      filter: blur(10px);
      transform: scale(0.9, 0.9);
    }

    .cards .red {
      background-color: #9a1e1e;
      height: 50%;
    }

    .cards .blue {
      background-color: #0a3cff;
    }

    .cards .green {
      background-color: #28A745;
    }

    .cards .yellow {
      background-color: #F7DC6F;
    }

    .cards .card span {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>

  <body>
    <div class="top-bar">
      <div class="title-area">
        <h1><a href="index.html">Tlapeng Digital Tuckshop</a></h1>
      </div>
      <div class="top-bar-section">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>
    </div>

    <div class="about-section">
      <p class="tip">Our Vision and Mission</p>
      <p class="second-text">Tlapeng Digital Tuckshop's mission is to provide convenience and quality products to customers through digital means, offering quick delivery and seamless transactions.</p>
    </div>

    <div class="cards">
      <div class="card red">
        <span class="tip">Our Mission</span>
        <span class="second-text">Delivering excellent products and services, creating a positive experience for every customer.</span>
      </div>
      <div class="card blue">
        <span class="tip">Our Vision</span>
        <span class="second-text">To transform the digital shopping experience, making it accessible, fast, and reliable for everyone.</span>
      </div>
      <div class="card green">
        <span class="tip">Our Values</span>
        <span class="second-text">Commitment to excellence, customer satisfaction, innovation, and integrity in all our dealings.</span>
      </div>
    </div>

    <footer>
      <p>&copy; 2025 Tlapeng Digital Tuckshop. All Rights Reserved.</p>
    </footer>
  </body>
</html>
