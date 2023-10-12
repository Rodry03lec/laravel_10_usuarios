<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>LOGIN</title>
    <link rel="icon" type="image/png" href="{{ asset('admin_template/images/logo/favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('admin_template/css/app.css') }}">

  <style>
    #error_estilo{
        color:red;
        text-align: center;
        font-size: 14px;
    }
    #success_estilo{
        color:rgb(0, 177, 24);
        text-align: center;
        font-size: 14px;
    }
</style>
</head>

<body class=" font-inter skin-default">
    <div class="loginwrapper">
        <div class="lg-inner-column">
            <div class="right-column relative">
                <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
                    <div class="auth-box h-full flex flex-col justify-center">
                        <div class="mobile-logo text-center mb-6 lg:hidden block flex flex-col justify-center items-center">
                            <img src="{{ asset('admin_template/images/logo/logo.svg') }}" style="max-width: 100%;"  alt="" class="mb-10 dark_logo">
                        </div>
                        <div class="text-center 2xl:mb-10 mb-4">
                            <h4 class="font-medium">LOGIN</h4>
                        </div>
                        <!-- BEGIN: Registration Form -->
                        <form class="space-y-4" id="form_login" method="POST" autocomplete="off">
                            @csrf
                            <div id="mensaje_error"></div>
                                <div class="fromGroup">
                                    <label class="block capitalize form-label">usuario</label>
                                    <div class="relative">
                                        <input type="text" name="usuario" id="usuario" class="form-control py-2" placeholder="Ingrese su usuario">
                                    </div>
                                </div>
                                <div class="fromGroup">
                                    <label class="block capitalize form-label">contraseña</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" class="form-control py-2" placeholder="Ingrese su contraseña">
                                    </div>
                                </div>
                        </form>
                        <div class="py-3">
                            <button class="btn btn-dark block w-full text-center" id="btn_ingresar">INGRESAR</button>
                        </div>

                    </div>
                    <div class="auth-footer text-center">
                        Rodry All Rights Reserved.
                    </div>
                </div>
            </div>
            <div class="left-column bg-cover bg-no-repeat bg-center " style="background-image: url(admin_template/images/all-img/login-bg.png);">
                <div class="flex flex-col h-full justify-center">
                    <div class="flex-1 flex flex-col justify-center items-center">
                        <img src="{{ asset('admin_template/images/logo/logo-white.svg') }}" alt="" class="mb-10">
                    </div>
                    <div>
                        <div class="black-500-title max-w-[525px] mx-auto pb-20 text-center">
                            DES
                            <span class="text-white font-bold">DES</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    let boton_ingresar = document.getElementById('btn_ingresar');
    boton_ingresar.addEventListener('click', async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('form_login')).entries());
        try {
            let respuesta = await fetch("{{ route('ingresar') }}",{
                method:'POST',
                headers:{
                    'Content-Type':'aplication/json'
                },
                body:JSON.stringify(datos)
            });
            let data = await respuesta.json();
            if(data.tipo==='success'){
                document.getElementById('mensaje_error').innerHTML = `<p id="success_estilo" >`+data.mensaje+`</p>`;
                window.location = '';
            }
            if(data.tipo==='error'){
                document.getElementById('mensaje_error').innerHTML = `<p id="error_estilo" >`+data.mensaje+`</p>`;
            }
        } catch (error) {
            console.log('Existe un error: '+error);
        }
    });
</script>
