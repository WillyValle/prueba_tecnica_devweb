/**
 * Funciones genericas para edicion inline de tablas - Adaptado para Prueba_Tecnica_DB
 */

let filaEnEdicion = null;
let datosOriginales = {};
let configuracionControladores = {
    'budgetitems': {
        url: '?c=budgetitems&a=ActualizarInline',
        campos: ['name', 'description']
    },
    'projects': {
        url: '?c=projects&a=ActualizarInline',
        campos: ['project_name', 'municipality', 'department', 'start_date', 'end_date']
    },
    'donors': {
        url: '?c=donors&a=ActualizarInline',
        campos: ['name', 'description']
    },
    'suppliers': {
        url: '?c=suppliers&a=ActualizarInline',
        campos: ['name', 'description']
    }
};

// Configuración específica de campos por tabla
let configuracionCampos = {
    'budgetitems': {
        campos: [
            { nombre: 'name', tipo: 'text', label: 'Nombre', requerido: true },
            { nombre: 'description', tipo: 'textarea', label: 'Descripción', requerido: false }
        ]
    },
    'projects': {
        campos: [
            { nombre: 'project_name', tipo: 'text', label: 'Nombre del Proyecto', requerido: true },
            { nombre: 'municipality', tipo: 'text', label: 'Municipio', requerido: true },
            { nombre: 'department', tipo: 'text', label: 'Departamento', requerido: true },
            { nombre: 'start_date', tipo: 'date', label: 'Fecha de Inicio', requerido: true },
            { nombre: 'end_date', tipo: 'date', label: 'Fecha de Finalización', requerido: false }
        ]
    },
    'donors': {
        campos: [
            { nombre: 'name', tipo: 'text', label: 'Nombre', requerido: true },
            { nombre: 'description', tipo: 'textarea', label: 'Descripción', requerido: false }
        ]
    },
    'suppliers': {
        campos: [
            { nombre: 'name', tipo: 'text', label: 'Nombre', requerido: true },
            { nombre: 'description', tipo: 'textarea', label: 'Descripción', requerido: false }
        ]
    }
};

// Función para convertir fecha del formato mostrado al formato de input
function convertirFechaParaInput(fechaMostrada) {
    if (!fechaMostrada || fechaMostrada === 'Sin definir' || fechaMostrada.trim() === '') {
        return '';
    }
    
    try {
        // Formato mostrado: "03/09/2025" (solo fecha)
        // Formato necesario: "2025-09-03"
        
        const fechaLimpia = fechaMostrada.trim().split(' ')[0]; // Solo tomar la parte de la fecha
        const [dia, mes, año] = fechaLimpia.split('/');
        
        if (!dia || !mes || !año) return '';
        
        return `${año}-${mes.padStart(2, '0')}-${dia.padStart(2, '0')}`;
    } catch (error) {
        console.error('Error al convertir fecha:', error);
        return '';
    }
}

// Función para convertir celdas editables
function convertirCeldasEditables(fila, id, tabla) {
    const celdas = fila.querySelectorAll('td');
    const config = configuracionCampos[tabla];
    
    if (!config) {
        console.error('Configuración no encontrada para tabla:', tabla);
        return;
    }
    
    config.campos.forEach((campo, index) => {
        if (celdas[index]) {
            const valorActual = celdas[index].textContent.trim();
            
            if (campo.tipo === 'text') {
                celdas[index].innerHTML = `<input type="text" class="celda-input form-control form-control-sm" id="edit-${campo.nombre}-${id}" value="${valorActual}" ${campo.requerido ? 'required' : ''}>`;
            } else if (campo.tipo === 'textarea') {
                celdas[index].innerHTML = `<textarea class="celda-textarea form-control form-control-sm" id="edit-${campo.nombre}-${id}" rows="2" ${campo.requerido ? 'required' : ''}>${valorActual}</textarea>`;
            } else if (campo.tipo === 'date') {
                // Convertir la fecha mostrada al formato date input
                const fechaFormateada = convertirFechaParaInput(valorActual);
                celdas[index].innerHTML = `<input type="date" class="celda-input form-control form-control-sm" id="edit-${campo.nombre}-${id}" value="${fechaFormateada}" ${campo.requerido ? 'required' : ''}>`;
            }
        }
    });
}

// Función para mostrar las fechas en la fila visual
function actualizarFilaVisual(id, tabla, datosActualizados) {
    const fila = document.getElementById(`fila-${id}-${tabla}`);
    if (!fila) return;
    
    const celdas = fila.querySelectorAll('td');
    const config = configuracionCampos[tabla];
    
    if (!config) return;
    
    // Actualizar cada campo en la fila
    config.campos.forEach((campo, index) => {
        if (celdas[index] && datosActualizados[campo.nombre] !== undefined) {
            let valorMostrar = datosActualizados[campo.nombre];
            
            // Si es un campo de fecha, formatear para mostrar
            if (campo.tipo === 'date' && valorMostrar && valorMostrar.trim() !== '') {
                try {
                    const fecha = new Date(valorMostrar + 'T00:00:00'); // Agregar tiempo para evitar problemas de zona horaria
                    if (!isNaN(fecha.getTime())) {
                        valorMostrar = fecha.toLocaleDateString('es-ES', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        });
                    }
                } catch (error) {
                    console.error('Error al formatear fecha:', error);
                }
            } else if (campo.tipo === 'date' && (!valorMostrar || valorMostrar.trim() === '')) {
                valorMostrar = 'Sin definir';
            }
            
            celdas[index].textContent = valorMostrar;
        }
    });
}

// Iniciar edicion de una fila
function editarFila(id, tabla) {
    // Si ya hay una fila en edicion, cancelar primero
    if (filaEnEdicion) {
        cancelarEdicion();
    }

    const fila = document.getElementById(`fila-${id}-${tabla}`);
    if (!fila) {
        console.error(`No se encontro la fila con ID: fila-${id}-${tabla}`);
        return;
    }

    // Detectar el controlador basado en la tabla
    const controlador = detectarControlador(tabla);
    console.log('Controlador detectado:', controlador); // Debug
    
    filaEnEdicion = { id, tabla, elemento: fila, controlador };

    // Hacer opacas las demas filas
    aplicarOpacidadFilas(tabla, id);

    // Resaltar fila en edicion
    fila.classList.add('fila-editando');

    // Guardar datos originales
    guardarDatosOriginales(fila, id, tabla);

    // Convertir celdas a inputs editables
    convertirCeldasEditables(fila, id, tabla);

    // Cambiar botones de accion
    cambiarBotonesAccion(fila, id, tabla);
}

function detectarControlador(tabla = null) {
    // Si se pasa el parámetro tabla, usarlo directamente
    if (tabla && configuracionControladores[tabla]) {
        return tabla;
    }
    
    // Detectar controlador por la URL actual
    const urlParams = new URLSearchParams(window.location.search);
    const controladorUrl = urlParams.get('c');
    
    console.log('URL params c:', controladorUrl); // Debug
    
    if (controladorUrl && configuracionControladores[controladorUrl]) {
        return controladorUrl;
    }
    
    // Fallback: detectar por elementos en la página
    if (document.querySelector('#tabla-budgetitems') || document.querySelector('[id*="budgetitem"]')) {
        return 'budgetitems';
    } else if (document.querySelector('#tabla-projects') || document.querySelector('[id*="project"]')) {
        return 'projects';
    } else if (document.querySelector('#tabla-donors') || document.querySelector('[id*="donor"]')) {
        return 'donors';
    } else if (document.querySelector('#tabla-suppliers') || document.querySelector('[id*="supplier"]')) {
        return 'suppliers';
    }
    
    // Detectar por URL como último recurso
    const currentUrl = window.location.href.toLowerCase();
    if (currentUrl.includes('budgetitems')) return 'budgetitems';
    if (currentUrl.includes('projects')) return 'projects';
    if (currentUrl.includes('donors')) return 'donors';
    if (currentUrl.includes('suppliers')) return 'suppliers';
    
    // Default
    return 'budgetitems';
}

function aplicarOpacidadFilas(tabla, idExcluir) {
    const filas = document.querySelectorAll(`[id^="fila-"][id*="-${tabla}"]`);
    filas.forEach(fila => {
        if (!fila.id.includes(`fila-${idExcluir}-`)) {
            fila.classList.add('fila-opaca');
        }
    });
}

function guardarDatosOriginales(fila, id, tabla) {
    const celdas = fila.querySelectorAll('td');
    const config = configuracionCampos[tabla];
    
    datosOriginales[id] = {};
    
    if (config) {
        config.campos.forEach((campo, index) => {
            if (celdas[index]) {
                datosOriginales[id][campo.nombre] = celdas[index].textContent.trim();
            }
        });
    }
    
    console.log('Datos originales guardados:', datosOriginales[id]); // Debug
}

function cambiarBotonesAccion(fila, id, tabla) {
    const celdaAcciones = fila.querySelector('td:last-child');
    celdaAcciones.innerHTML = `
        <div class="botones-edicion">
            <button class="btn btn-success btn-sm me-1" onclick="guardarEdicion(${id}, '${tabla}')">
                <i class="fas fa-save"></i> Guardar
            </button>
            <button class="btn btn-secondary btn-sm" onclick="cancelarEdicion()">
                <i class="fas fa-times"></i> Cancelar
            </button>
        </div>
    `;
}

function cancelarEdicion() {
    if (!filaEnEdicion) return;

    const { id, tabla, elemento } = filaEnEdicion;

    // Remover clases de edicion
    elemento.classList.remove('fila-editando');

    // Restaurar opacidad de todas las filas
    const todasLasFilas = document.querySelectorAll(`[id^="fila-"][id*="-${tabla}"]`);
    todasLasFilas.forEach(fila => {
        fila.classList.remove('fila-opaca');
    });

    // Restaurar contenido original
    restaurarContenidoOriginal(elemento, id, tabla);

    // Limpiar variables
    filaEnEdicion = null;
    delete datosOriginales[id];
}

function restaurarContenidoOriginal(fila, id, tabla) {
    const datos = datosOriginales[id];
    const celdas = fila.querySelectorAll('td');
    const config = configuracionCampos[tabla];
    
    if (!config || !datos) return;
    
    // Restaurar los campos de datos
    config.campos.forEach((campo, index) => {
        if (celdas[index] && datos[campo.nombre] !== undefined) {
            celdas[index].textContent = datos[campo.nombre];
        }
    });
    
    // Restaurar botones originales (asumiendo que están en la última celda)
    const ultimaCelda = celdas[celdas.length - 1];
    if (ultimaCelda) {
        ultimaCelda.innerHTML = `
            <button class="btn btn-warning btn-sm" onclick="editarFila(${id}, '${tabla}')">
                <i class="fas fa-edit"></i> Editar
            </button>
        `;
    }
}

function guardarEdicion(id, tabla) {
    if (!filaEnEdicion) {
        console.error('No hay fila en edición');
        return;
    }

    const config = configuracionCampos[tabla];
    if (!config) {
        mostrarMensajeError('Error: Configuración de tabla no encontrada.');
        return;
    }

    // Obtener valores actuales y validar
    const datosActualizados = {};
    let hayErrores = false;
    
    config.campos.forEach(campo => {
        const elemento = document.getElementById(`edit-${campo.nombre}-${id}`);
        if (elemento) {
            const valor = elemento.value.trim();
            
            // Validar campos requeridos
            if (campo.requerido && !valor) {
                mostrarMensajeError(`Por favor complete el campo ${campo.label}.`);
                elemento.focus();
                hayErrores = true;
                return;
            }
            
            datosActualizados[campo.nombre] = valor;
        }
    });
    
    if (hayErrores) return;

    console.log('Datos a enviar:', { id, ...datosActualizados }); // Debug

    // Obtener URL del controlador
    const controlador = filaEnEdicion.controlador;
    const configControlador = configuracionControladores[controlador];
    
    console.log('Controlador:', controlador, 'Config:', configControlador); // Debug
    
    if (!configControlador) {
        mostrarMensajeError('Error: Controlador no configurado.');
        return;
    }

    // Mostrar indicador de carga
    mostrarCargando(true);

    // Preparar datos para envio
    const datosFormulario = new FormData();
    datosFormulario.append('id', id);
    
    // Agregar todos los campos al FormData
    Object.keys(datosActualizados).forEach(key => {
        datosFormulario.append(key, datosActualizados[key]);
    });

    console.log('URL a enviar:', configControlador.url); // Debug
    
    // Enviar datos via AJAX
    fetch(configControlador.url, {
        method: 'POST',
        body: datosFormulario
    })
    .then(response => {
        console.log('Response status:', response.status); // Debug
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data); // Debug
        mostrarCargando(false);
        
        if (data.success) {
            manejarActualizacionExitosa(id, tabla, datosActualizados);
        } else {
            mostrarMensajeError('Error al actualizar: ' + (data.message || 'Error desconocido'));
        }
    })
    .catch(error => {
        console.error('Error en fetch:', error);
        mostrarCargando(false);
        mostrarMensajeError('Error de conexión al guardar los cambios.');
    });
}

function mostrarCargando(mostrar) {
    const botonGuardar = document.querySelector('.botones-edicion .btn-success');
    if (botonGuardar) {
        if (mostrar) {
            botonGuardar.disabled = true;
            botonGuardar.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';
        } else {
            botonGuardar.disabled = false;
            botonGuardar.innerHTML = '<i class="fas fa-save"></i> Guardar';
        }
    }
}

function manejarActualizacionExitosa(id, tabla, datosActualizados) {
    // Mostrar mensaje de exito
    mostrarMensajeExito('¡Registro actualizado exitosamente!');
    
    // Cancelar edición para restaurar la vista normal
    cancelarEdicion();
    
    // Actualizar los datos en la fila
    actualizarFilaVisual(id, tabla, datosActualizados);
    
    // Actualizar contadores si existen
    actualizarContadores();
}

function actualizarContadores() {
    // Actualizar contadores generales si existen
    const tablas = Object.keys(configuracionControladores);
    
    tablas.forEach(tabla => {
        const filas = document.querySelectorAll(`#tabla-${tabla} tbody tr`).length;
        const contador = document.getElementById(`contador-${tabla}`);
        if (contador) {
            contador.textContent = filas;
        }
    });
}

// Funciones auxiliares para mostrar mensajes
function mostrarMensajeExito(mensaje) {
    mostrarMensaje(mensaje, 'success', 'check-circle');
}

function mostrarMensajeError(mensaje) {
    mostrarMensaje(mensaje, 'danger', 'exclamation-circle');
}

function mostrarMensaje(mensaje, tipo, icono) {
    // Remover mensaje anterior si existe
    const mensajeAnterior = document.getElementById('mensajeInline');
    if (mensajeAnterior) {
        mensajeAnterior.remove();
    }

    const alertHtml = `
        <div class="alert alert-${tipo} alert-dismissible fade show" role="alert" id="mensajeInline" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            <i class="fas fa-${icono}"></i> ${mensaje}
            <button type="button" class="close" onclick="document.getElementById('mensajeInline').remove()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
    
    document.body.insertAdjacentHTML('afterbegin', alertHtml);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        const alert = document.getElementById('mensajeInline');
        if (alert) {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150);
        }
    }, 5000);
}

// Manejar escape key para cancelar edicion
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && filaEnEdicion) {
        cancelarEdicion();
    }
});

// Debug: Agregar evento para verificar cuando se carga el script
document.addEventListener('DOMContentLoaded', function() {
    console.log('inline-edit.js cargado correctamente');
    console.log('Controlador detectado al cargar:', detectarControlador());
});