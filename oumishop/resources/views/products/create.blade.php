<x-app-layout>
    <div class="luxury-header">
        <div class="container">
            <h1 class="luxury-title">AJOUTER UN PRODUIT</h1>
            <p class="luxury-subtitle">Créez votre nouveau sac de luxe</p>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="luxury-form-container">
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="luxury-form">
            @csrf
                    
                    <div class="form-section">
                        <h3 class="section-title">Informations du produit</h3>
                        
                        <div class="form-group">
                            <label for="nom" class="form-label">Nom du produit</label>
                            <input type="text" 
                                   class="form-control-luxury" 
                                   placeholder="Ex: Sac Prada Classic" 
                                   id="nom" 
                                   name="nom" 
                                   value="{{ old('nom') }}" 
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="prix" class="form-label">Prix (FCFA)</label>
                            <input type="number" 
                                   class="form-control-luxury" 
                                   placeholder="Ex: 150000" 
                                   id="prix" 
                                   name="prix" 
                                   value="{{ old('prix') }}" 
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="stock" class="form-label">Quantité en stock</label>
                            <input type="number" 
                                   class="form-control-luxury" 
                                   placeholder="Ex: 5" 
                                   id="stock" 
                                   name="stock" 
                                   value="{{ old('stock') }}" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3 class="section-title">Photos du produit</h3>
    
    <!-- Zone pour afficher les photos sélectionnées -->
                        <div id="selectedPhotos" class="photo-preview-container"></div>
    
    <!-- Bouton pour ajouter une nouvelle photo -->
                        <button type="button" class="btn-add-photo" onclick="addPhotoInput()">
                            <span>+</span> Ajouter une photo
    </button>
    
    <!-- Conteneur pour les inputs de fichiers -->
    <div id="photoInputs"></div>
</div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-submit-luxury">
                            Créer le produit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .luxury-header {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        color: #d4af37;
        padding: 2rem 0;
        text-align: center;
        border-bottom: 3px solid #d4af37;
    }
    
    .luxury-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 300;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
    }
    
    .luxury-subtitle {
        font-family: 'Montserrat', sans-serif;
        font-size: 1rem;
        color: #f5f5f5;
        letter-spacing: 1px;
    }
    
    .luxury-form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        border: 2px solid #e5e5e5;
    }
    
    .luxury-form {
        padding: 2rem;
    }
    
    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 50px;
        height: 2px;
        background: #d4af37;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-control-luxury {
        width: 100%;
        padding: 1rem;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        font-family: 'Montserrat', sans-serif;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fafafa;
    }
    
    .form-control-luxury:focus {
        outline: none;
        border-color: #d4af37;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        background: white;
    }
    
    .form-control-luxury::placeholder {
        color: #999;
        font-style: italic;
    }
    
    .photo-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
        min-height: 120px;
        padding: 1rem;
        border: 2px dashed #d4af37;
        border-radius: 8px;
        background: #f8f9fa;
    }
    
    .photo-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #d4af37;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .btn-add-photo {
        background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%);
        border: none;
        color: white;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.875rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .btn-add-photo:hover {
        background: linear-gradient(135deg, #b8941f 0%, #d4af37 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
    }
    
    .btn-add-photo span {
        font-size: 1.2rem;
        font-weight: 700;
    }
    
    .photo-input-group {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e5e5e5;
    }
    
    .photo-input-group input[type="file"] {
        flex: 1;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-family: 'Montserrat', sans-serif;
    }
    
    .btn-remove-photo {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        color: white;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.75rem;
        cursor: pointer;
    }
    
    .btn-remove-photo:hover {
        background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }
    
    .form-actions {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #f0f0f0;
    }
    
    .btn-submit-luxury {
        background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%);
        border: none;
        color: white;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 30px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 1rem;
        cursor: pointer;
        min-width: 200px;
    }
    
    .btn-submit-luxury:hover {
        background: linear-gradient(135deg, #b8941f 0%, #d4af37 100%);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
    }
    
    .error-message {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        border: none;
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
    }
    
    .success-message {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;600;700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

<script>
let photoCount = 0;

function addPhotoInput() {
    photoCount++;
    
    const container = document.getElementById('photoInputs');
    const inputDiv = document.createElement('div');
    inputDiv.className = 'photo-input-group';
    inputDiv.innerHTML = `
        <input type="file" name="photos[]" class="form-control-luxury" accept="image/*" 
               onchange="previewPhoto(this, ${photoCount})">
        <button type="button" class="btn-remove-photo" onclick="removePhoto(this)">
            Supprimer
        </button>
    `;
    
    container.appendChild(inputDiv);
}

function previewPhoto(input, count) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('selectedPhotos');
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'photo-preview';
            img.id = `preview-${count}`;
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

function removePhoto(button) {
    const inputDiv = button.parentElement;
    const input = inputDiv.querySelector('input');
    const file = input.files[0];
    
    if (file) {
        // Supprimer la prévisualisation
        const previews = document.querySelectorAll('#selectedPhotos img');
        previews.forEach(img => {
            if (img.src.includes(file.name)) {
                img.remove();
            }
        });
    }
    
    // Supprimer l'input
    inputDiv.remove();
}

// Ajouter le premier input automatiquement
document.addEventListener('DOMContentLoaded', function() {
    addPhotoInput();
});
</script>