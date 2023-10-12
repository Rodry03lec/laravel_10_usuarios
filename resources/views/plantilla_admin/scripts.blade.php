<script src="{{ asset('admin_template/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin_template/js/rt-plugins.js') }}"></script>
<script src="{{ asset('admin_template/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.js"></script> --}}
{{--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}


<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.js"></script>

<script>
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Espera a que la página se cargue completamente
    window.addEventListener('load', function() {
    var loader = document.getElementById('loading-wrapper');
        loader.style.display = 'none';
    });

    //para cerrar la session
    let btn_cerrar_session = document.getElementById("btn-cerrar-session");
    btn_cerrar_session.addEventListener("click", async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('formulario_salir')).entries());
        try {
            let respuesta = await fetch("{{ route('salir') }}",{
                method:"POST",
                headers:{
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(datos)
            });
            let dato = await respuesta.json();
            alerta_top(dato.tipo, dato.mensaje);
            setTimeout(() => {
                window.location = '';
            }, 1500);

        } catch (error) {
            console.log('Ocurrio un error: '+error);
        }
    });

    function alerta_top(tipo, mensaje){
        Swal.fire({
            position: 'top-end',
            icon: tipo,
            title: mensaje,
            showConfirmButton: false,
            timer: 1500
        })
    }

    //PARA GUARDAR LOS DATOS PERSONALES
    let btn_guardar_informacion_personal = document.getElementById('btn_informacion_personal');
    btn_guardar_informacion_personal.addEventListener("click", async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('form_informacion_personal')).entries());
        limpiar_campos('form_informacion_personal');
        vaciar_errores_perfil();
        try {
            let respuesta = await fetch("{{ route('guardar_perfil') }}",{
                method: "POST",
                headers:{
                    'Content-Type':'application/json',
                },
                body: JSON.stringify(datos)
            });
            let dato = await respuesta.json();
            if(dato.tipo==='errores'){
                let obj = dato.mensaje;
                for (let key in obj) {
                    document.getElementById('_'+key).innerHTML = `<p id="error_estilo" >`+obj[key]+`</p>`;
                }
            }
            if(dato.tipo==='success'){
                alerta_top(dato.tipo, dato.mensaje);
                setTimeout(() => {
                    window.location = '';
                }, 1500);
            }
            if(dato.tipo==='error'){
                alerta_top(dato.tipo, dato.mensaje);
            }
        } catch (error) {
            console.log('Ocurrio un error: '+error);
        }
    });
    //para guardar el usuario y contraseña
    let btn_password_guardar = document.getElementById('btn_password');
    btn_password_guardar.addEventListener("click", async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('form_password')).entries());
        limpiar_campos('form_password');
        vaciar_errores_perfil();
        try {
            let respuesta = await fetch("{{ route('guardar_password') }}",{
                method: "POST",
                headers:{
                    'Content-Type':'application/json',
                },
                body: JSON.stringify(datos)
            });
            let dato = await respuesta.json();
            if(dato.tipo==='errores'){
                let obj = dato.mensaje;
                for (let key in obj) {
                    document.getElementById('_'+key).innerHTML = `<p id="error_estilo" >`+obj[key]+`</p>`;
                }
            }
            if(dato.tipo==='success'){
                alerta_top(dato.tipo, dato.mensaje);
                limpiar_campos('form_password');
                setTimeout( async () => {
                    let datos = Object.fromEntries(new FormData(document.getElementById('formulario_salir')).entries());
                    try {
                        let respuesta = await fetch("{{ route('salir') }}",{
                            method:"POST",
                            headers:{
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(datos)
                        });
                        let dato = await respuesta.json();
                        alerta_top(dato.tipo, 'vuelva a iniciar la session con la nueva contraseña');
                        setTimeout(() => {
                            window.location = '';
                        }, 1500);

                    } catch (error) {
                        console.log('Ocurrio un error: '+error);
                    }
                }, 1500);
            }
            if(dato.tipo==='error'){
                alerta_top(dato.tipo, dato.mensaje);
            }
        } catch (error) {
            console.log('Ocurrio un error: '+error);
        }
    });

    function cerrar_modal_perfil(){
        vaciar_errores_perfil();
        limpiar_campos('form_informacion_personal');
        limpiar_campos('form_password');
    }


    function vaciar_errores_perfil(){
        document.getElementById('_email').innerHTML           =   '';
        document.getElementById('_celular').innerHTML           =   '';

        document.getElementById('_password').innerHTML           =   '';
        document.getElementById('_confirmar_password').innerHTML =   '';
    }


    //para reset de formulario
    function limpiar_campos(form_id){
        document.getElementById(form_id).reset();
    }

    //para que no funcione el enter
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
            if(e.keyCode == 13) {
                e.preventDefault();
            }
        }))
    });


</script>
