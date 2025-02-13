# PDFer

A basic API tool that creates PDFs from HTML or a URL.

> This application is currently live at:  
> https://pdfer.codeadam.ca

This tool uses a basic Laravel app with Browsershot and Puppeteer to generate PDFs. Here are the steps to create a new Google Cloud E2 server and install the necessary libraries.

1. Login to the [GCP Console](https://console.cloud.google.com/) and create a new E2 server using Ubuntu 22 LTS x86/64.
2. Change the IP address to a static IP.
3. Open up the GCP SSH tool and run a few update and upgrade commands:

    ```
    sudo apt update
    sudo apt upgrade
    sudo apt autoremove
    ```

4. Install Apache using these commannds:

    ```
    sudo apt install apt-utils 
    sudo apt install apache2 apache2-utils 
    sudo service apache2 restart
    ```

6. 

---

## Project Stack

This project uses [PHP](https://www.php.net/), [Laravel](https://www.php.net/manual/en/book.image.php), and [Browsershot](https://spatie.be/docs/browsershot/v4/introduction).

<img src="https://console.codeadam.ca/api/image/php" width="60"> <img src="https://console.codeadam.ca/api/image/laravel" width="60">

---

## Repo Resources

* [Laravel](https://laravel.com/)
* [Browsershot](https://spatie.be/docs/browsershot/v4/introduction)

<a href="https://codeadam.ca">
<img src="https://cdn.codeadam.ca/images@1.0.0/codeadam-logo-coloured-horizontal.png" width="200">
</a>
