/**
 * Configuración de Livewire para WAMP64
 * 
 * Este archivo contiene la configuración personalizada de Livewire
 * para funcionar correctamente en un entorno WAMP64 local.
 * 
 * Funcionalidades incluidas:
 * - Inicialización segura de Livewire
 * - Configuración de hooks para eventos del ciclo de vida
 * - Manejo de estados de conexión (online/offline)
 * - Logging detallado para debugging
 * 
 * @author Sistema de Gestión
 * @version 1.0.0
 * @since 2024-09-16
 */

(function() {
    'use strict';
    
    /**
     * Inicialización principal del sistema Livewire
     * 
     * Se ejecuta cuando el DOM está completamente cargado
     * para asegurar que todos los elementos estén disponibles.
     */
    document.addEventListener('DOMContentLoaded', function() {
        
        // Verificar disponibilidad de Livewire en el contexto global
        if (typeof window.Livewire !== 'undefined') {
            console.log('✓ Livewire está disponible y configurado correctamente');
            
            /**
             * Configuración de Hooks de Livewire
             * 
             * Los hooks permiten ejecutar código personalizado en momentos
             * específicos del ciclo de vida de los componentes Livewire.
             */
            if (window.Livewire.hook) {
                
                /**
                 * Hook: message.processed
                 * Se ejecuta después de que Livewire procesa un mensaje del servidor
                 */
                window.Livewire.hook('message.processed', (message, component) => {
                    console.log('📨 Mensaje de Livewire procesado:', message);
                    
                    // Aquí se pueden agregar acciones personalizadas después del procesamiento
                    // Por ejemplo: actualizar indicadores de carga, mostrar notificaciones, etc.
                });
                
                /**
                 * Hook: component.initialized
                 * Se ejecuta cuando un componente Livewire es inicializado
                 */
                window.Livewire.hook('component.initialized', (component) => {
                    console.log('🚀 Componente Livewire inicializado:', component.name);
                    
                    // Configuraciones específicas por componente pueden ir aquí
                });
                
                /**
                 * Hook: element.updated
                 * Se ejecuta cuando un elemento del DOM es actualizado por Livewire
                 */
                window.Livewire.hook('element.updated', (el, component) => {
                    console.log('🔄 Elemento actualizado por Livewire');
                    
                    // Reinicializar plugins de terceros si es necesario
                    // Por ejemplo: tooltips, datepickers, etc.
                });
            }
            
            /**
             * Configuración de eventos globales de Livewire
             * 
             * Estos eventos pueden ser disparados desde cualquier componente
             * y escuchados globalmente en la aplicación.
             */
            if (window.Livewire.on) {
                
                /**
                 * Evento personalizado: refreshComponent
                 * Utilizado para refrescar componentes específicos
                 */
                window.Livewire.on('refreshComponent', () => {
                    console.log('🔄 Componente refrescado mediante evento personalizado');
                });
                
                /**
                 * Evento personalizado: showNotification
                 * Utilizado para mostrar notificaciones desde componentes Livewire
                 */
                window.Livewire.on('showNotification', (data) => {
                    console.log('🔔 Notificación recibida:', data);
                    // Aquí se puede integrar con sistemas de notificaciones como Toastr, SweetAlert, etc.
                });
            }
            
        } else {
            // Livewire no está disponible - mostrar advertencia
            console.warn('⚠️ Livewire no está disponible. Verificar la carga de scripts.');
            console.warn('Posibles causas:');
            console.warn('- @livewireScripts no está incluido en el layout');
            console.warn('- Error en la carga del archivo livewire.js');
            console.warn('- Conflicto con otros scripts JavaScript');
        }
    });
    
    /**
     * Event Listeners para eventos del ciclo de vida de Livewire
     * 
     * Estos eventos son disparados automáticamente por Livewire
     * en diferentes momentos de su ejecución.
     */
    
    /**
     * Evento: livewire:load
     * Se dispara cuando Livewire ha terminado de cargar completamente
     */
    window.addEventListener('livewire:load', function () {
        console.log('✅ Livewire cargado completamente y listo para usar');
        
        // Aquí se pueden inicializar funcionalidades que dependen de Livewire
        // Por ejemplo: configurar interceptores, inicializar plugins, etc.
    });
    
    /**
     * Evento: livewire:offline
     * Se dispara cuando se pierde la conexión con el servidor
     */
    window.addEventListener('livewire:offline', function () {
        console.warn('🔴 Conexión perdida. Algunas funciones pueden no estar disponibles.');
        
        // Mostrar indicador visual de pérdida de conexión
        // Deshabilitar formularios o mostrar mensaje al usuario
        document.body.classList.add('livewire-offline');
    });
    
    /**
     * Evento: livewire:online
     * Se dispara cuando se restaura la conexión con el servidor
     */
    window.addEventListener('livewire:online', function () {
        console.log('🟢 Conexión restaurada. Todas las funciones están disponibles.');
        
        // Ocultar indicador de pérdida de conexión
        // Rehabilitar formularios
        document.body.classList.remove('livewire-offline');
    });
    
    /**
     * Evento: livewire:beforeDomUpdate
     * Se dispara antes de que Livewire actualice el DOM
     */
    window.addEventListener('livewire:beforeDomUpdate', function () {
        console.log('⏳ Preparando actualización del DOM...');
        
        // Guardar estado de elementos que podrían perderse
        // Por ejemplo: posición de scroll, focus de elementos, etc.
    });
    
    /**
     * Evento: livewire:afterDomUpdate
     * Se dispara después de que Livewire actualiza el DOM
     */
    window.addEventListener('livewire:afterDomUpdate', function () {
        console.log('✨ DOM actualizado correctamente');
        
        // Restaurar estado guardado
        // Reinicializar plugins de terceros si es necesario
    });
    
})();