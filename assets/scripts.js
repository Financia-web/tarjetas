document.addEventListener("DOMContentLoaded", () => {
    const tipoPlanSelect = document.getElementById('plan');
    const tarjetaSelect = document.getElementById('tarjeta');
    const planCuotasSelect = document.getElementById('plan_cuotas');
    const cuotasInput = document.getElementById('cuotas'); // ahora es un input
    const valorCuotaInput = document.getElementById('valor_cuota');
    const totalInput = document.getElementById('total');
    const montoInput = document.getElementById('monto');
    const formCalculo = document.getElementById('form-calculo');

    let idenCuota = null; // para guardar el ID real de la cuota

    // 1. Cargar tipos de planes
    fetch('api/getTiposPlanes.php')
        .then(res => res.json())
        .then(data => {
            data.forEach(plan => {
                const option = document.createElement('option');
                option.value = plan.id;
                option.textContent = plan.nombre;
                tipoPlanSelect.appendChild(option);
            });
        })
        .catch(err => console.error('Error cargando tipos de plan:', err));

    // 2. Al cambiar tipo de plan, cargar tarjetas
    tipoPlanSelect.addEventListener('change', () => {
        const tipoPlanId = tipoPlanSelect.value;

        tarjetaSelect.innerHTML = '<option value="">Seleccione...</option>';
        tarjetaSelect.disabled = true;

        planCuotasSelect.innerHTML = '<option value="">Seleccione...</option>';
        planCuotasSelect.disabled = true;

        cuotasInput.value = '';
        valorCuotaInput.value = '';
        totalInput.value = '';
        idenCuota = null;

        if (!tipoPlanId) return;

        fetch(`api/getTarjetas.php?id_tipo_plan=${tipoPlanId}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(tarjeta => {
                    const option = document.createElement('option');
                    option.value = tarjeta.id;
                    option.textContent = tarjeta.nombre;
                    tarjetaSelect.appendChild(option);
                });
                tarjetaSelect.disabled = false;
            })
            .catch(err => console.error('Error cargando tarjetas:', err));
    });

    // 3. Al cambiar tarjeta, cargar planes de cuotas
    tarjetaSelect.addEventListener('change', () => {
        const tarjetaId = tarjetaSelect.value;

        planCuotasSelect.innerHTML = '<option value="">Seleccione...</option>';
        planCuotasSelect.disabled = true;

        cuotasInput.value = '';
        valorCuotaInput.value = '';
        totalInput.value = '';
        idenCuota = null;

        if (!tarjetaId) return;

        fetch(`api/getPlanesCuotas.php?id_tarjeta=${tarjetaId}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(planCuota => {
                    const option = document.createElement('option');
                    option.value = planCuota.id;
                    option.textContent = planCuota.nombre;
                    planCuotasSelect.appendChild(option);
                });
                planCuotasSelect.disabled = false;
            })
            .catch(err => console.error('Error cargando planes de cuotas:', err));
    });

    // 4. Al cambiar plan de cuotas, cargar cuota asociada
    planCuotasSelect.addEventListener('change', () => {
        const planCuotaId = planCuotasSelect.value;
        //console.log(planCuotaId);

        cuotasInput.value = '';
        valorCuotaInput.value = '';
        totalInput.value = '';
        idenCuota = null;

        if (!planCuotaId) return;

        fetch(`api/getCuotas.php?id_plan_cuotas=${planCuotaId}`)
            .then(res => res.json())
            .then(data => {
                //console.log('Respuesta de getCuotas:', data);
                if (data.length > 0) {
                    //console.log('Respuesta de getCuotas:', data);
                    const cuota = data[0];
                    cuotasInput.value = cuota.nombre;
                    idenCuota = cuota.id;
                }
            })
            .catch(err => console.error('Error cargando cuota:', err));
    });

    // 5. Calcular valor de cuota y total al enviar formulario
    formCalculo.addEventListener('submit', e => {
        e.preventDefault();

        const monto = parseFloat(montoInput.value);
        const cuotaId = idenCuota;

        if (!monto || !cuotaId) {
            alert('Por favor ingrese el monto y seleccione todas las opciones.');
            return;
        }
        //console.log('Detalle de cuota:', cuotaId);
        fetch(`api/getDetalleCuota.php?id_cuota=${cuotaId}`)
            .then(res => res.json())
            .then(data => {
                //console.log('Detalle de cuota:', data); // <- Agrega esto para ver la respuesta
                if (data.error) {
                    alert(data.error);
                    return;
                }

                const cantidad = parseInt(data.id);
                const interes = parseFloat(data.nombre);

                const interesTotal = monto * (interes / 100);
                const total = monto + interesTotal;
                const valorCuota = total / cantidad;

                valorCuotaInput.value = valorCuota.toFixed(2);
                totalInput.value = total.toFixed(2);
            })
            .catch(err => {
                console.error('Error calculando cuota:', err);
                alert('Error al calcular la cuota.');
            });
    });

    // Reiniciar el formulario al recargar la página (ej: F5)
    window.addEventListener('beforeunload', () => {
        document.getElementById('form-calculo').reset();
    });

    window.addEventListener('beforeunload', () => {
        document.getElementById('form-calculo').reset();
        document.getElementById('cuotas').value = '';
        document.getElementById('valor_cuota').value = '';
        document.getElementById('total').value = '';
    });


});
