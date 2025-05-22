<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Subscription Modal</title>

  <style>
    *, *::before, *::after {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .wrapper {
      display: flex;
      justify-content: center;
      height: 100vh;
      align-items: center;
      background-color: -rgba(243, 237, 237, 0.92);
      transition: 0.3s ease-in-out;
      opacity: 0;
      visibility: hidden;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      z-index: 998;
    }

    .modal-cont {
      max-width: 54rem;
      max-height: 28rem;
      background:#6B1434; 
      box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.04);
      padding: 64px;
      display: flex;
      justify-content: space-between;
      border-radius: 0.5rem;
      position: relative;
      transform: translateY(-12.5rem);
      opacity: 0;
      visibility: hidden;
      z-index: 999;
      margin: 32px;
      font-family: Arial, sans-serif;
    }

    .--active {
      opacity: 1 !important;
      visibility: visible !important;
      transform: translateY(0) !important;
      transition: opacity 0.3s ease-in-out, transform 1s;
    }

    .close-btn {
      position: absolute;
      right: 2.35rem;
      top: 1.85rem;
      background: none;
      border: none;
      cursor: pointer;
    }

    .close-btn svg {
      fill: white;
    }

    .modal-left {
      display: flex;
      flex-direction: column;
      justify-content: space-evenly;
      width: 56%;
      color: #fff;
      font-family: Arial, sans-serif;
    }

    .modal-title {
        font-family: Arial, sans-serif;
        font-size: 2rem;
        line-height: 2.5rem;
        font-weight: 900;
        margin-bottom: 40px;
    }

    .color-title {
      color:#E87BAA; 
         font-family: 'Open Sans', sans-serif;
    }

    .modal-btn {
      width: 23.25rem;
      height: 3rem;
      padding: 0;
      border-radius: 0.25rem;
      border: none;
      background-color: #fefefe;
      color:#6B1434; 
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }

    .modal-btn:hover {
      background-color: transparent;
      border: solid 0.094rem #fefefe;
      color: #fefefe;
    }

    .modal-right {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #fefefe;
      font-family: Arial, sans-serif;
    }

    .image-desktop {
      position: relative;
      bottom: -42px;
      left: 25px;
      max-width: 300px;
      height: auto;
    }

    .image-mobile {
      display: none;
    }

    @media screen and (max-width: 48em) {
      .image-desktop {
        display: none;
      }

      .image-mobile {
        display: inline;
        position: relative;
        bottom: -38px;
      }

      .modal-cont {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 40px 24px;
        max-width: 700px;
        max-height: unset;
      }

      .modal-left {
        align-items: center;
        width: unset;
      }

      .modal-title {
        text-align: left;
        margin-bottom: 24px;
        font-size: 1.4rem;
        line-height: 2rem;
      }

      .modal-btn {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="wrapper">
    <div class="modal-cont">
      <svg class="close-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="16px" height="16px">
        <path d="M 38.982422 6.9707031 A 2.0002 2.0002 0 0 0 37.585938 7.5859375 L 24 21.171875 L 10.414062 7.5859375 A 2.0002 2.0002 0 0 0 8.9785156 6.9804688 A 2.0002 2.0002 0 0 0 7.5859375 10.414062 L 21.171875 24 L 7.5859375 37.585938 A 2.0002 2.0002 0 1 0 10.414062 40.414062 L 24 26.828125 L 37.585938 40.414062 A 2.0002 2.0002 0 1 0 40.414062 37.585938 L 26.828125 24 L 40.414062 10.414062 A 2.0002 2.0002 0 0 0 38.982422 6.9707031 z"/>
      </svg>
      <div class="modal-left">
        <h1 class="modal-title">
          Oh no!
         <br>
          <span class="color-title"> You're not subscribed yet.</span><br>

        </h1>
            <span class="message"> To gain full access to our p. Would you like to explore our subscription plans?</span><br>
        </h1>
        <a href="../common_user/index.php?page=memberships" onclick="location.href=this.href+'?callback='+returnPage;return false;" class="modal-btn link">View Subscription Plans</a>
      </div>
      <div class="modal-right">
        <img class="image-desktop" src="../img/barbelpic.png" alt="Modal Background" />
        <img class="image-mobile" src="../img/barbelpic.png" alt="Modal Mobile Footer" />
      </div>
    </div>
  </div>

  <script>
    const modalWrapper = document.querySelector('.wrapper');
    const modalCont = document.querySelector('.modal-cont');
    const closeModal = document.querySelector('.close-btn');
    const btn = document.querySelector('.link');

    setTimeout(() => {
      modalWrapper.classList.add('--active');
      modalCont.classList.add('--active');
    }, 1000);

    modalWrapper.addEventListener('click', (e) => {
      if (e.target === modalWrapper || e.target === closeModal || e.target === btn) {
        modalWrapper.classList.remove('--active');
        modalCont.classList.remove('--active');
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === "Escape") {
        modalWrapper.classList.remove('--active');
        modalCont.classList.remove('--active');
      }
    });

    let returnPage = '';
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('callback')) {
      returnPage = urlParams.get('callback');
    }
  </script>

</body>
</html>