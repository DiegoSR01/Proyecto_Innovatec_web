(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🎬 Media Manager iniciado');
        
        const form = document.getElementById('media-form');
        const bannerInput = document.getElementById('banner-input');
        const galleryInput = document.getElementById('gallery-input');
        const videoInput = document.getElementById('video-input');
        
        // Drag and drop zones
        const bannerDropZone = document.getElementById('banner-drop-zone');
        const galleryDropZone = document.getElementById('gallery-drop-zone');
        const videoDropZone = document.getElementById('video-drop-zone');
        
        // Preview areas
        const bannerPreview = document.getElementById('banner-preview');
        const galleryPreview = document.getElementById('gallery-preview');
        const videoPreview = document.getElementById('video-preview');
        
        let galleryFiles = [];
        let videoFiles = [];
        
        // Configurar drag and drop para banner
        setupDragAndDrop(bannerDropZone, bannerInput, 'image');
        setupDragAndDrop(galleryDropZone, galleryInput, 'image');
        setupDragAndDrop(videoDropZone, videoInput, 'video');
        
        // Event listeners para inputs
        bannerInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                previewBannerImage(this.files[0]);
            }
        });
        
        galleryInput.addEventListener('change', function() {
            handleGalleryFiles(this.files);
        });
        
        videoInput.addEventListener('change', function() {
            handleVideoFiles(this.files);
        });
        
        // Botón omitir
        document.getElementById('skip-media').addEventListener('click', function() {
            if (confirm('¿Estás seguro de que quieres omitir la subida de media? Podrás agregarlo después.')) {
                // Esta redirección será reemplazada por el script en la vista que usa route() de Laravel
                console.log('🔄 Omitiendo media...');
            }
        });
        
        // Validación del formulario
        form.addEventListener('submit', function(e) {
            console.log('📤 Enviando formulario de media...');
            
            const formData = new FormData(form);
            const hasFiles = bannerInput.files.length > 0 || 
                            galleryFiles.length > 0 || 
                            videoFiles.length > 0;
            
            if (!hasFiles) {
                if (confirm('No has seleccionado ningún archivo. ¿Quieres continuar sin media?')) {
                    console.log('✅ Continuando sin media...');
                    // No prevenir el envío del formulario
                    return true;
                }
                e.preventDefault();
                return false;
            }
            
            // Validar tamaños de archivo
            if (validateFileSizes()) {
                console.log('✅ Archivos válidos, enviando...');
                // Mostrar indicador de progreso
                showUploadProgress();
                return true;
            } else {
                e.preventDefault();
                return false;
            }
        });
        
        function setupDragAndDrop(dropZone, input, fileType) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => highlight(dropZone), false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => unhighlight(dropZone), false);
            });
            
            dropZone.addEventListener('drop', function(e) {
                const files = e.dataTransfer.files;
                
                if (fileType === 'image') {
                    if (dropZone === bannerDropZone) {
                        if (files.length > 0 && files[0].type.startsWith('image/')) {
                            input.files = files;
                            previewBannerImage(files[0]);
                        }
                    } else if (dropZone === galleryDropZone) {
                        const imageFiles = Array.from(files).filter(f => f.type.startsWith('image/'));
                        if (imageFiles.length > 0) {
                            handleGalleryFiles(imageFiles);
                        }
                    }
                } else if (fileType === 'video' && dropZone === videoDropZone) {
                    const videoFiles = Array.from(files).filter(f => f.type.startsWith('video/'));
                    if (videoFiles.length > 0) {
                        handleVideoFiles(videoFiles);
                    }
                }
            }, false);
        }
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        function highlight(dropZone) {
            dropZone.classList.add('border-accent', 'bg-accent/10');
        }
        
        function unhighlight(dropZone) {
            dropZone.classList.remove('border-accent', 'bg-accent/10');
        }
        
        function previewBannerImage(file) {
            if (!file.type.startsWith('image/')) {
                alert('Por favor selecciona solo archivos de imagen');
                return;
            }
            
            if (file.size > 5 * 1024 * 1024) {
                alert('La imagen es demasiado grande. Máximo 5MB permitido');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('banner-preview-img').src = e.target.result;
                bannerPreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
        
        function handleGalleryFiles(files) {
            const newFiles = Array.from(files).filter(file => {
                if (!file.type.startsWith('image/')) {
                    alert(`${file.name} no es una imagen válida`);
                    return false;
                }
                if (file.size > 5 * 1024 * 1024) {
                    alert(`${file.name} es demasiado grande (máximo 5MB)`);
                    return false;
                }
                return true;
            });
            
            // Limitar a 10 imágenes total
            const totalFiles = galleryFiles.length + newFiles.length;
            if (totalFiles > 10) {
                alert(`Máximo 10 imágenes permitidas. Tienes ${galleryFiles.length} y estás agregando ${newFiles.length}`);
                return;
            }
            
            galleryFiles = galleryFiles.concat(newFiles);
            updateGalleryPreview();
            updateGalleryInput();
        }
        
        function handleVideoFiles(files) {
            const newFiles = Array.from(files).filter(file => {
                if (!file.type.startsWith('video/')) {
                    alert(`${file.name} no es un video válido`);
                    return false;
                }
                if (file.size > 50 * 1024 * 1024) {
                    alert(`${file.name} es demasiado grande (máximo 50MB)`);
                    return false;
                }
                return true;
            });
            
            // Limitar a 3 videos total
            const totalFiles = videoFiles.length + newFiles.length;
            if (totalFiles > 3) {
                alert(`Máximo 3 videos permitidos. Tienes ${videoFiles.length} y estás agregando ${newFiles.length}`);
                return;
            }
            
            videoFiles = videoFiles.concat(newFiles);
            updateVideoPreview();
            updateVideoInput();
        }
        
        function updateGalleryPreview() {
            if (galleryFiles.length === 0) {
                galleryPreview.classList.add('hidden');
                return;
            }
            
            galleryPreview.classList.remove('hidden');
            galleryPreview.innerHTML = '';
            
            galleryFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border border-card">
                        <button type="button" onclick="removeGalleryImage(${index})" 
                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                            ×
                        </button>
                        <div class="absolute bottom-1 left-1 bg-black/50 text-white text-xs px-2 py-1 rounded">
                            ${formatFileSize(file.size)}
                        </div>
                    `;
                    galleryPreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
        
        function updateVideoPreview() {
            if (videoFiles.length === 0) {
                videoPreview.classList.add('hidden');
                return;
            }
            
            videoPreview.classList.remove('hidden');
            videoPreview.innerHTML = '';
            
            videoFiles.forEach((file, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between bg-card/20 rounded-lg p-4';
                div.innerHTML = `
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-accent/20 rounded-lg flex items-center justify-center">
                            🎥
                        </div>
                        <div>
                            <p class="text-text font-medium">${file.name}</p>
                            <p class="text-[#8da3ce] text-sm">${formatFileSize(file.size)}</p>
                        </div>
                    </div>
                    <button type="button" onclick="removeVideo(${index})" 
                            class="text-red-400 hover:text-red-300 transition-colors">
                        🗑️
                    </button>
                `;
                videoPreview.appendChild(div);
            });
        }
        
        function updateGalleryInput() {
            const dt = new DataTransfer();
            galleryFiles.forEach(file => dt.items.add(file));
            galleryInput.files = dt.files;
        }
        
        function updateVideoInput() {
            const dt = new DataTransfer();
            videoFiles.forEach(file => dt.items.add(file));
            videoInput.files = dt.files;
        }
        
        // Funciones globales para remover archivos
        window.removeBannerPreview = function() {
            bannerPreview.classList.add('hidden');
            bannerInput.value = '';
        };
        
        window.removeGalleryImage = function(index) {
            galleryFiles.splice(index, 1);
            updateGalleryPreview();
            updateGalleryInput();
        };
        
        window.removeVideo = function(index) {
            videoFiles.splice(index, 1);
            updateVideoPreview();
            updateVideoInput();
        };
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        function validateFileSizes() {
            // Validar banner
            if (bannerInput.files.length > 0) {
                const bannerFile = bannerInput.files[0];
                if (bannerFile.size > 5 * 1024 * 1024) {
                    alert('La imagen banner es demasiado grande (máximo 5MB)');
                    return false;
                }
            }
            
            // Validar galería
            for (let file of galleryFiles) {
                if (file.size > 5 * 1024 * 1024) {
                    alert(`La imagen ${file.name} es demasiado grande (máximo 5MB)`);
                    return false;
                }
            }
            
            // Validar videos
            for (let file of videoFiles) {
                if (file.size > 50 * 1024 * 1024) {
                    alert(`El video ${file.name} es demasiado grande (máximo 50MB)`);
                    return false;
                }
            }
            
            return true;
        }
        
        function showUploadProgress() {
            const progressDiv = document.getElementById('upload-progress');
            const submitBtn = document.getElementById('submit-media');
            
            if (progressDiv && submitBtn) {
                progressDiv.classList.remove('hidden');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span>Subiendo...</span>';
                
                console.log('📊 Mostrando progreso de subida');
            }
        }
        
        console.log('✅ Media Manager configurado completamente');
    });
})();
