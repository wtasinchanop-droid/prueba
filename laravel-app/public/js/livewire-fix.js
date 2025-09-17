// Fix para Livewire en WAMP64
(function() {
    'use strict';
    
    // Variable para evitar múltiples inicializaciones
    let livewireInitialized = false;
    
    // Función para cargar Livewire dinámicamente
    function loadLivewire() {
        // Evitar cargar múltiples veces
        if (livewireInitialized || typeof window.Livewire !== 'undefined') {
            console.log('Livewire already loaded or initialized');
            return;
        }
        
        livewireInitialized = true;
        
        const script = document.createElement('script');
        script.src = '/prueba/laravel-app/public/vendor/livewire/livewire.js';
        script.onload = function() {
            console.log('Livewire loaded successfully from custom path');
            
            // Configurar Livewire para usar las rutas correctas
            if (window.Livewire && !window.Livewire.started) {
                try {
                    window.Livewire.start();
                } catch (error) {
                    console.warn('Livewire start error (may already be started):', error);
                }
            }
        };
        script.onerror = function() {
            console.error('Failed to load Livewire from custom path');
            livewireInitialized = false;
        };
        document.head.appendChild(script);
    }
    
    // Verificar si Livewire ya está cargado
    if (typeof window.Livewire === 'undefined') {
        // Si no está cargado, intentar cargarlo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadLivewire);
        } else {
            loadLivewire();
        }
    } else {
        console.log('Livewire already available globally');
    }
})();