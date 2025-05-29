<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <title>Calculadora de Venta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/scripts.js" defer></script>
    <!-- Importamos Inter y activamos el modo oscuro en Tailwind -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        html {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script>
      // Config Tailwind para habilitar modo oscuro por clase
      tailwind.config = {
        darkMode: 'class'
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-orange-100 to-yellow-200 dark:from-gray-900 dark:to-gray-800 min-h-screen p-6 transition-colors duration-500">

    <div class="max-w-xl mx-auto bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8 transition-colors duration-500">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-orange-600 dark:text-orange-400">Simulador de Venta</h1>
        </div>

        <form id="form-calculo" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Monto de la Compra</label>
                <input type="text" name="monto" id="monto" step="0.01"
                    class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 p-3 shadow-sm transition dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-orange-500 dark:focus:border-orange-500 dark:text-white text-right">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Plan</label>
                <select id="plan"
                    class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 p-3 shadow-sm transition dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-orange-500 dark:focus:border-orange-500 dark:text-white text-center">
                    <option value="">Seleccione...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tarjeta</label>
                <select id="tarjeta" disabled
                    class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 p-3 shadow-sm transition dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-orange-500 dark:focus:border-orange-500 dark:text-white text-center">
                    <option value="">Seleccione...</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="plan_cuotas" class="block text-gray-700 dark:text-gray-300 mb-1">Plan de Cuotas:</label>
                <select id="plan_cuotas" class="w-full border p-2 rounded text-center" disabled>
                    <option value="">Seleccione...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cantidad de Cuotas</label>
                <input type="text" id="cuotas" readonly
                    class="w-full rounded-xl bg-gray-100 border border-gray-300 p-3 shadow-inner text-gray-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 text-right">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Valor de cada Cuota</label>
                <input type="text" id="valor_cuota" readonly
                    class="w-full rounded-xl bg-gray-100 border border-gray-300 p-3 shadow-inner text-gray-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 text-right">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Importe Total</label>
                <input type="text" id="total" readonly
                    class="w-full rounded-xl bg-gray-100 border border-gray-300 p-3 shadow-inner text-gray-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 text-right">
            </div>

            <div class="pt-2 text-center flex justify-center space-x-4">
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full shadow-md transition">
                    Calcular
                </button>
                <button type="button" id="btn-reset"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-3 rounded-full shadow-md transition">
                    Limpiar
                </button>
            </div>

            <div id="resultado" class="text-center text-green-600 font-semibold text-lg mt-4"></div>
        </form>
    </div>

    <script>
        document.getElementById('btn-reset').addEventListener('click', () => {
            const form = document.getElementById('form-calculo');
            form.reset();

            // Reset select dependientes
            document.getElementById('tarjeta').innerHTML = '<option value="">Seleccione...</option>';
            document.getElementById('tarjeta').disabled = true;

            document.getElementById('plan_cuotas').innerHTML = '<option value="">Seleccione...</option>';
            document.getElementById('plan_cuotas').disabled = true;

            // Limpiar campos calculados
            document.getElementById('cuotas').value = '';
            document.getElementById('valor_cuota').value = '';
            document.getElementById('total').value = '';
            document.getElementById('resultado').innerHTML = '';
        });
    </script>

</body>
</html>
