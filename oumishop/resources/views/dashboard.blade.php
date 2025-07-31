<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    
    .product-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-color: #d4af37;
    }
    
    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.05);
    }
    
    .product-info {
        padding: 1rem;
        overflow: hidden;
    }
    
    .product-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.3rem;
        line-height: 1.2;
    }
    
    .product-price {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: #d4af37;
        margin-bottom: 0.3rem;
    }
    
    .product-stock {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.875rem;
        color: #666;
        margin-bottom: 0.5rem;
    }
    
    .btn-luxury {
        background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%);
        border: none;
        color: white;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.75rem;
    }
    
    .btn-luxury:hover {
        background: linear-gradient(135deg, #b8941f 0%, #d4af37 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
        color: white;
    }
    
    .btn-danger-luxury {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        color: white;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.75rem;
    }
    
    .btn-danger-luxury:hover {
        background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        color: white;
    }
    
    .btn-group-luxury {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    
    .btn-group-luxury .btn-luxury,
    .btn-group-luxury .btn-danger-luxury {
        flex: 1;
        min-width: 0;
        white-space: nowrap;
        font-size: 0.75rem;
        padding: 0.5rem 1rem;
    }
    
    .photo-indicator {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(212, 175, 55, 0.9);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .image-container {
        position: relative;
        overflow: hidden;
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
    
    .pagination-luxury .page-link {
        color: #d4af37;
        border-color: #d4af37;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
    }
    
    .pagination-luxury .page-item.active .page-link {
        background-color: #d4af37;
        border-color: #d4af37;
        color: white;
    }
    
    .pagination-luxury .page-link:hover {
        background-color: #d4af37;
        border-color: #d4af37;
        color: white;
    }

    /* Responsive mobile pour afficher 2 produits par ligne */
    @media (max-width: 768px) {
        .grid {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 0.75rem !important;
        }
        
        .product-card {
            margin: 0;
            display: flex;
            flex-direction: column;
            height: auto;
        }
        
        .product-image {
            height: 140px !important;
        }
        
        .product-info {
            padding: 0.5rem !important;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-name {
            font-size: 0.875rem !important;
            margin-bottom: 0.15rem !important;
            line-height: 1.1 !important;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .product-price {
            font-size: 1rem !important;
            margin-bottom: 0.15rem !important;
        }
        
        .product-stock {
            font-size: 0.75rem !important;
            margin-bottom: 0.3rem !important;
            flex-grow: 1;
        }
        
        .btn-group-luxury {
            flex-direction: column;
            gap: 0.15rem !important;
            margin-top: auto !important;
        }
        
        .btn-group-luxury .btn-luxury,
        .btn-group-luxury .btn-danger-luxury {
            font-size: 0.65rem !important;
            padding: 0.3rem 0.4rem !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .photo-indicator {
            font-size: 0.6rem !important;
            padding: 0.1rem 0.25rem !important;
        }
    }

    /* Pour très petits écrans, garder 2 colonnes mais plus compact */
    @media (max-width: 480px) {
        .grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 0.5rem !important;
        }
        
        .product-image {
            height: 120px !important;
        }
        
        .product-info {
            padding: 0.4rem !important;
        }
        
        .product-name {
            font-size: 0.8rem !important;
            margin-bottom: 0.1rem !important;
        }
        
        .product-price {
            font-size: 0.9rem !important;
            margin-bottom: 0.1rem !important;
        }
        
        .product-stock {
            font-size: 0.7rem !important;
            margin-bottom: 0.25rem !important;
        }
        
        .btn-group-luxury .btn-luxury,
        .btn-group-luxury .btn-danger-luxury {
            font-size: 0.6rem !important;
            padding: 0.25rem 0.3rem !important;
            min-height: 26px;
        }
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;600;700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

<x-app-layout>
    <div class="luxury-header">
        <div class="container">
            <h1 class="luxury-title">OUMISHOP COLLECTION</h1>
            <p class="luxury-subtitle">Exclusive Designer Handbags & Accessories</p>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Récupération des produits directement dans la vue --}}
            @php
                $products = App\Models\products::orderBy('created_at', 'desc')->paginate(12);
            @endphp

            {{-- Affichage des produits --}}
            <div class="mt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="product-card">
                            <div class="image-container">
                                @if($product->photos->count() > 0)
                                    <img src="{{ asset('storage/' . $product->photos->first()->photo) }}"
                                         alt="{{ $product->nom }}"
                                         class="product-image cursor-pointer"
                                         onclick="openGallery({{ $product->id }}, 0)">
                                    
                                    @if($product->photos->count() > 1)
                                        <div class="photo-indicator">
                                            {{ $product->photos->count() }} photos
                                        </div>
                                    @endif
                                @else
                                    <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                                        <span class="text-gray-400 text-sm">Aucune photo</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="product-info">
                                <h3 class="product-name">{{ $product->nom }}</h3>
                                <p class="product-price">{{ number_format($product->prix) }} FCFA</p>
                                <p class="product-stock">En stock: {{ $product->stock }} unités</p>
                                
                                <div class="btn-group-luxury">
                                    <button
                                        type="button"
                                        class="btn-luxury"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalModifier"
                                        data-product-id="{{ $product->id }}"
                                        data-product-nom="{{ $product->nom }}"
                                        data-product-prix="{{ $product->prix }}"
                                        data-product-stock="{{ $product->stock }}"
                                        data-product-photos="{{ json_encode($product->photos->pluck('photo')) }}"
                                    >
                                        Modifier
                                    </button>
                                    <a href="/delete-product/{{ $product->id }}" 
                                       class="btn-danger-luxury" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                        Supprimer
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($products->hasPages())
                    <div class="mt-8 flex justify-center">
                        <nav class="pagination-luxury">
                            {{ $products->links() }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>


{{-- Galerie modale améliorée --}}
<div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 hidden">
    <div class="relative bg-white rounded-lg p-4 max-w-4xl w-full mx-4">
        <button onclick="closeGallery()" class="absolute top-4 right-4 text-gray-700 text-3xl hover:text-gray-900">&times;</button>
        
        <div class="flex items-center justify-center">
            <button onclick="prevImage()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 mr-4">
                &larr; Précédent
            </button>
            
            <img id="galleryImage" src="" alt="" class="max-w-full max-h-96 object-contain rounded">
            
            <button onclick="nextImage()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 ml-4">
                Suivant &rarr;
            </button>
        </div>
        
        <div class="text-center mt-4">
            <span id="galleryCaption" class="font-semibold text-lg"></span>
            <div class="text-sm text-gray-600 mt-2">
                <span id="imageCounter"></span>
            </div>
        </div>
    </div>
</div>

<script>
    // Stocke les photos de chaque produit
    let galleries = @json($products->mapWithKeys(fn($p) => [$p->id => $p->photos->pluck('photo')]));
    let currentGallery = [];
    let currentIndex = 0;

    function openGallery(productId, index) {
        currentGallery = galleries[productId];
        currentIndex = index;
        showImage();
        document.getElementById('galleryModal').classList.remove('hidden');
    }

    function closeGallery() {
        document.getElementById('galleryModal').classList.add('hidden');
    }

    function showImage() {
        const img = document.getElementById('galleryImage');
        const caption = document.getElementById('galleryCaption');
        const counter = document.getElementById('imageCounter');
        
        img.src = '/storage/' + currentGallery[currentIndex];
        caption.textContent = `Photo ${currentIndex + 1} sur ${currentGallery.length}`;
        counter.textContent = `${currentIndex + 1} / ${currentGallery.length}`;
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + currentGallery.length) % currentGallery.length;
        showImage();
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % currentGallery.length;
        showImage();
    }

    // Fermer la galerie avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeGallery();
        }
    });
</script>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .modal-luxury .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    
    .modal-luxury .modal-header {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        color: #d4af37;
        border-bottom: 2px solid #d4af37;
        border-radius: 15px 15px 0 0;
    }
    
    .modal-luxury .modal-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .modal-luxury .btn-close {
        filter: invert(1);
    }
    
    .modal-luxury .form-label {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }
    
    .modal-luxury .form-control {
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        padding: 0.75rem;
        font-family: 'Montserrat', sans-serif;
        transition: all 0.3s ease;
    }
    
    .modal-luxury .form-control:focus {
        border-color: #d4af37;
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
    }
    
    .modal-luxury .btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        color: white;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .modal-luxury .btn-secondary:hover {
        background: linear-gradient(135deg, #495057 0%, #6c757d 100%);
        transform: translateY(-2px);
        color: white;
    }
    
    .modal-luxury .btn-primary {
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
    }
    
    .modal-luxury .btn-primary:hover {
        background: linear-gradient(135deg, #b8941f 0%, #d4af37 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
        color: white;
    }
    
    .current-photos-container {
        border: 2px dashed #d4af37;
        border-radius: 8px;
        padding: 1rem;
        background: #f8f9fa;
        min-height: 120px;
    }
    
    .photo-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #d4af37;
    }
    
    .delete-photo-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
</style>

<div class="modal fade modal-luxury" id="modalModifier" tabindex="-1" aria-labelledby="modalModifierLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalModifierLabel">Modifier le produit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formModifier" enctype="multipart/form-data">
          <input type="hidden" id="productId" name="id">
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nom" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
              </div>
              <div class="mb-3">
                <label for="prix" class="form-label">Prix (FCFA)</label>
                <input type="number" class="form-control" id="prix" name="prix" required>
              </div>
              <div class="mb-3">
                <label for="stock" class="form-label">Stock disponible</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Photos actuelles</label>
                <div id="currentPhotos" class="current-photos-container">
                  <!-- Les photos actuelles seront affichées ici -->
                </div>
              </div>
              
              <div class="mb-3">
                <label for="newPhotos" class="form-label">Ajouter de nouvelles photos</label>
                <input type="file" class="form-control" id="newPhotos" name="photos[]" multiple accept="image/*">
                <small class="text-muted">Sélectionnez une ou plusieurs photos</small>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" onclick="sauvegarderModification()">Sauvegarder</button>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('modalModifier').addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  document.getElementById('productId').value = button.getAttribute('data-product-id');
  document.getElementById('nom').value = button.getAttribute('data-product-nom');
  document.getElementById('prix').value = button.getAttribute('data-product-prix');
  document.getElementById('stock').value = button.getAttribute('data-product-stock');
  
  // Afficher les photos actuelles
  const photos = JSON.parse(button.getAttribute('data-product-photos'));
  const currentPhotosDiv = document.getElementById('currentPhotos');
  
  if (photos.length > 0) {
    currentPhotosDiv.innerHTML = '';
    photos.forEach((photo, index) => {
      const photoContainer = document.createElement('div');
      photoContainer.className = 'd-inline-block me-2 mb-2 position-relative';
      photoContainer.innerHTML = `
        <img src="/storage/${photo}" alt="Photo ${index + 1}" class="photo-thumbnail">
        <button type="button" class="delete-photo-btn" 
                onclick="supprimerPhoto('${photo}', ${index})" title="Supprimer cette photo">
          ×
        </button>
      `;
      currentPhotosDiv.appendChild(photoContainer);
    });
  } else {
    currentPhotosDiv.innerHTML = '<p class="text-muted">Aucune photo disponible</p>';
  }
});

function supprimerPhoto(photoName, index) {
  if (confirm('Voulez-vous vraiment supprimer cette photo ?')) {
    // Ajouter la photo à une liste de photos à supprimer
    if (!window.photosToDelete) {
      window.photosToDelete = [];
    }
    window.photosToDelete.push(photoName);
    
    // Masquer la photo dans l'interface
    const photoElements = document.querySelectorAll('#currentPhotos .position-relative');
    if (photoElements[index]) {
      photoElements[index].style.display = 'none';
    }
  }
}

function sauvegarderModification() {
  const formData = new FormData(document.getElementById('formModifier'));
  
  // Vérifier si des fichiers sont sélectionnés
  const fileInput = document.getElementById('newPhotos');
  if (fileInput.files.length > 0) {
    // Supprimer les entrées vides et ajouter les vrais fichiers
    formData.delete('photos[]');
    for (let i = 0; i < fileInput.files.length; i++) {
      if (fileInput.files[i].size > 0) {
        formData.append('photos[]', fileInput.files[i]);
      }
    }
  }
  
  // Debug: Afficher les données envoyées
  console.log('Données envoyées:');
  for (let [key, value] of formData.entries()) {
    console.log(key, value);
  }
  
  // Ajouter les photos à supprimer
  if (window.photosToDelete && window.photosToDelete.length > 0) {
    formData.append('photos_to_delete', JSON.stringify(window.photosToDelete));
    console.log('Photos à supprimer:', window.photosToDelete);
  }
  
  // Envoyer les données
  fetch('/update-product', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
  .then(response => {
    console.log('Response status:', response.status);
    return response.json();
  })
  .then(data => {
    console.log('Response data:', data);
    if (data.success) {
      alert('Produit modifié avec succès !');
      location.reload();
    } else {
      alert('Erreur : ' + data.message);
    }
  })
  .catch(error => {
    console.error('Erreur:', error);
    alert('Erreur lors de la sauvegarde');
  });
}
</script>