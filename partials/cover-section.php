<style>
    .slider-item {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top center;
        height: calc(100vh);
        min-height: 700px;
        position: relative
    }

    .slider-item:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #000;
        opacity: .3
    }

    .slider-item .slider-text {
        color: #fff;
        height: calc(100vh);
        min-height: 700px
    }

    .slider-item .slider-text .child-name {
        font-size: 40px;
        color: #fff
    }

    
    .slider-item .slider-text h1 {
        font-size: 5rem;
        color: #fff;
        line-height: 1.2;
        font-weight: 700 !important;
        margin-bottom: 30px;
        font-family: PoppinsReg, Roboto, Arial, sans-serif;
        text-transform: uppercase;
    }

    .slider-item .slider-text h1 span {
        color: white;
        background-color: #6f42c1;
        -webkit-box-shadow: 0.5em 0 0 #6f42c1, -0.5em 0 0 #6f42c1;
        box-shadow: 0.5em 0 0 #6f42c1, -0.5em 0 0 #6f42c1
    }

    @media (max-width:991.98px) {
        .slider-item .slider-text h1 {
            font-size: 3rem
        }
    }

    .slider-item .slider-text p {
        font-size: 20px;
        line-height: 1.5;
        font-weight: 300;
        color: white;
        margin: 0 auto
    }

    .slider-item .slider-text p a {
        color: #6f42c1;
        text-decoration: underline
    }

    .slider-item .slider-text p a:hover {
        color: #fff;
        text-decoration: underline
    }

    .slider-item .slider-text p.sub-text {
        line-height: 2
    }


    .slider-item h1 {
        font-weight: 900;
        color: #fff;
        font-size: 4rem;
        transform: translateY(-20px);
        opacity: 0;
        animation: 1s titleAni ease-out forwards;
    }
    @keyframes titleAni {
        0% {
            transform: translateY(-20px);
            opacity: 0;
        }
        100% {
            transform: translateY(0px);
            opacity: 1;
        }
    }
</style>



<div class="slider-item overlay" data-stellar-background-ratio="0.5"
    style="background-image: url('assets/hero_3.jpg');">
    <div class="container">
        <div class="row slider-text align-items-center justify-content-center">
        <div class="col-lg-12 text-center col-sm-12">
            <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">
                Digital Architects
            </h1>
            <p>
                We create amazing stuff
            </p>
        </div>
        </div>
    </div>
</div>




