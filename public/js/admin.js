// ========================================
// ADMIN PANEL JAVASCRIPT
// ========================================

// Global variables
let currentSection = 'dashboard';

// Initialize admin panel
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin panel initialized');
    loadDashboardData();
    setupEventListeners();
});

// ========================================
// SECTION NAVIGATION
// ========================================

function showSection(sectionName) {
    // Hide all sections
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.remove('active');
    });
    
    // Show selected section
    const selectedSection = document.getElementById(sectionName);
    if (selectedSection) {
        selectedSection.classList.add('active');
    }
    
    // Update navigation
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.classList.remove('active');
    });
    
    const activeLink = document.querySelector(`[href="#${sectionName}"]`);
    if (activeLink) {
        activeLink.classList.add('active');
    }
    
    currentSection = sectionName;
    
    // Load data for the section
    switch(sectionName) {
        case 'dashboard':
            loadDashboardData();
            break;
        case 'berita':
            loadBeritaData();
            break;
        case 'galeri':
            loadGaleriData();
            break;
        case 'carousel':
            loadCarouselData();
            break;
        case 'navbar':
            loadNavbarData();
            break;
        case 'dokumen':
            loadDokumenData();
            break;
    }
}

// ========================================
// EVENT LISTENERS
// ========================================

function setupEventListeners() {
    // Berita form
    const formBerita = document.getElementById('formBerita');
    if (formBerita) {
        formBerita.addEventListener('submit', handleBeritaSubmit);
    }
    
    // Galeri form
    const formGaleri = document.getElementById('formGaleri');
    if (formGaleri) {
        formGaleri.addEventListener('submit', handleGaleriSubmit);
    }
    
    // Carousel form
    const formCarousel = document.getElementById('formCarousel');
    if (formCarousel) {
        formCarousel.addEventListener('submit', handleCarouselSubmit);
    }
    
    // Navbar form
    const formNavbar = document.getElementById('formNavbar');
    if (formNavbar) {
        formNavbar.addEventListener('submit', handleNavbarSubmit);
    }
    
    // Dokumen form
    const formDokumen = document.getElementById('formDokumen');
    if (formDokumen) {
        formDokumen.addEventListener('submit', handleDokumenSubmit);
    }
}

// ========================================
// DASHBOARD FUNCTIONS
// ========================================

async function loadDashboardData() {
    try {
        // Load counts from database
        const response = await fetch('/admin/dashboard-data');
        if (response.ok) {
            const data = await response.json();
            updateDashboardCounts(data);
        }
    } catch (error) {
        console.error('Error loading dashboard data:', error);
    }
}

function updateDashboardCounts(data) {
    // Update dashboard cards with counts
    const totalBerita = document.querySelector('#dashboard .bg-primary h4');
    const totalGaleri = document.querySelector('#dashboard .bg-success h4');
    const totalCarousel = document.querySelector('#dashboard .bg-info h4');
    const totalDokumen = document.querySelector('#dashboard .bg-warning h4');
    
    if (totalBerita) totalBerita.textContent = data.totalBerita || 0;
    if (totalGaleri) totalGaleri.textContent = data.totalGaleri || 0;
    if (totalCarousel) totalCarousel.textContent = data.totalCarousel || 0;
    if (totalDokumen) totalDokumen.textContent = data.totalDokumen || 0;
}

// ========================================
// BERITA FUNCTIONS
// ========================================

async function loadBeritaData() {
    try {
        const response = await fetch('/admin/beritas');
        if (response.ok) {
            const beritas = await response.json();
            displayBeritaData(beritas);
        }
    } catch (error) {
        console.error('Error loading berita data:', error);
    }
}

async function handleBeritaSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('judul', document.getElementById('judulBerita').value);
    formData.append('kategori', document.getElementById('kategoriBerita').value);
    formData.append('tanggal', document.getElementById('tanggalBerita').value);
    formData.append('isi', document.getElementById('isiBerita').value);
    
    const gambarFile = document.getElementById('gambarBerita').files[0];
    if (gambarFile) {
        formData.append('gambar', gambarFile);
    }
    
    try {
        const response = await fetch('/admin/beritas', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            const result = await response.json();
            showAlert('Berita berhasil disimpan!', 'success');
            document.getElementById('formBerita').reset();
            document.getElementById('beritaPreview').style.display = 'none';
            loadBeritaData(); // Reload data
        } else {
            const error = await response.json();
            showAlert('Error: ' + (error.message || 'Gagal menyimpan berita'), 'danger');
        }
    } catch (error) {
        console.error('Error saving berita:', error);
        showAlert('Error: Gagal menyimpan berita', 'danger');
    }
}

function displayBeritaData(beritas) {
    const tbody = document.getElementById('tabelBerita');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (beritas.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada berita</td></tr>';
        return;
    }
    
    beritas.forEach((berita, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                ${berita.gambar ? `<img src="${berita.gambar}" alt="${berita.judul}" style="width: 50px; height: 50px; object-fit: cover;">` : '<i class="fas fa-image text-muted"></i>'}
            </td>
            <td>${berita.judul}</td>
            <td>${berita.kategori}</td>
            <td>${new Date(berita.tanggal).toLocaleDateString('id-ID')}</td>
            <td class="text-center">
                <button class="btn btn-sm btn-warning me-1" onclick="editBerita(${berita.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteBerita(${berita.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

async function deleteBerita(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus berita ini?')) return;
    
    try {
        const response = await fetch(`/admin/beritas/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            showAlert('Berita berhasil dihapus!', 'success');
            loadBeritaData(); // Reload data
        } else {
            showAlert('Error: Gagal menghapus berita', 'danger');
        }
    } catch (error) {
        console.error('Error deleting berita:', error);
        showAlert('Error: Gagal menghapus berita', 'danger');
    }
}

// ========================================
// GALERI FUNCTIONS
// ========================================

async function loadGaleriData() {
    try {
        const response = await fetch('/admin/galeri-fotos');
        if (response.ok) {
            const galeris = await response.json();
            displayGaleriData(galeris);
        }
    } catch (error) {
        console.error('Error loading galeri data:', error);
    }
}

async function handleGaleriSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('judul_album', document.getElementById('judulAlbum').value);
    formData.append('deskripsi', document.getElementById('deskripsiGaleri').value);
    formData.append('tanggal', document.getElementById('tanggalGaleri').value);
    
    const fotoFile = document.getElementById('fotoGaleri').files[0];
    if (fotoFile) {
        formData.append('foto', fotoFile);
    }
    
    try {
        const response = await fetch('/admin/galeri-fotos', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            const result = await response.json();
            showAlert('Foto galeri berhasil diupload!', 'success');
            document.getElementById('formGaleri').reset();
            document.getElementById('galeriPreview').style.display = 'none';
            loadGaleriData(); // Reload data
        } else {
            const error = await response.json();
            showAlert('Error: ' + (error.message || 'Gagal upload foto'), 'danger');
        }
    } catch (error) {
        console.error('Error uploading foto:', error);
        showAlert('Error: Gagal upload foto', 'danger');
    }
}

function displayGaleriData(galeris) {
    const container = document.getElementById('galeriContainer');
    if (!container) return;
    
    container.innerHTML = '';
    
    if (galeris.length === 0) {
        container.innerHTML = '<div class="col-12 text-center">Belum ada foto galeri</div>';
        return;
    }
    
    galeris.forEach((galeri, index) => {
        const col = document.createElement('div');
        col.className = 'col-md-4 mb-3';
        col.innerHTML = `
            <div class="card">
                <img src="${galeri.foto}" class="card-img-top" alt="${galeri.judul_album}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title">${galeri.judul_album}</h6>
                    <p class="card-text small">${galeri.deskripsi}</p>
                    <small class="text-muted">${new Date(galeri.tanggal).toLocaleDateString('id-ID')}</small>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-warning me-1" onclick="editGaleri(${galeri.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteGaleri(${galeri.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(col);
    });
}

// ========================================
// CAROUSEL FUNCTIONS
// ========================================

async function loadCarouselData() {
    try {
        const response = await fetch('/admin/carousels');
        if (response.ok) {
            const carousels = await response.json();
            displayCarouselData(carousels);
        }
    } catch (error) {
        console.error('Error loading carousel data:', error);
    }
}

async function handleCarouselSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('judul', document.getElementById('judulCarousel').value);
    formData.append('deskripsi', document.getElementById('deskripsiCarousel').value);
    
    const gambarFile = document.getElementById('gambarCarousel').files[0];
    if (gambarFile) {
        formData.append('gambar', gambarFile);
    }
    
    try {
        const response = await fetch('/admin/carousels', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            const result = await response.json();
            showAlert('Carousel berhasil ditambahkan!', 'success');
            document.getElementById('formCarousel').reset();
            document.getElementById('carouselPreview').style.display = 'none';
            loadCarouselData(); // Reload data
        } else {
            const error = await response.json();
            showAlert('Error: ' + (error.message || 'Gagal menambahkan carousel'), 'danger');
        }
    } catch (error) {
        console.error('Error adding carousel:', error);
        showAlert('Error: Gagal menambahkan carousel', 'danger');
    }
}

function displayCarouselData(carousels) {
    const tbody = document.getElementById('tabelCarousel');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (carousels.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center">Belum ada carousel</td></tr>';
        return;
    }
    
    carousels.forEach((carousel, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <img src="${carousel.gambar}" alt="${carousel.judul}" style="width: 100px; height: 60px; object-fit: cover;">
            </td>
            <td>${carousel.judul}</td>
            <td>${carousel.deskripsi}</td>
            <td class="text-center">
                <button class="btn btn-sm btn-warning me-1" onclick="editCarousel(${carousel.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteCarousel(${carousel.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// ========================================
// NAVBAR FUNCTIONS
// ========================================

async function loadNavbarData() {
    try {
        const response = await fetch('/admin/navbars');
        if (response.ok) {
            const navbars = await response.json();
            displayNavbarData(navbars);
        }
    } catch (error) {
        console.error('Error loading navbar data:', error);
    }
}

async function handleNavbarSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('nama_menu', document.getElementById('namaMenu').value);
    formData.append('urutan', document.getElementById('urutanMenu').value);
    
    // Get dropdown inputs
    const dropdownInputs = document.querySelectorAll('#dropdownInputs input');
    const dropdownValues = Array.from(dropdownInputs).map(input => input.value).filter(value => value.trim() !== '');
    formData.append('dropdown_menu', JSON.stringify(dropdownValues));
    
    try {
        const response = await fetch('/admin/navbars', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            const result = await response.json();
            showAlert('Menu navbar berhasil disimpan!', 'success');
            document.getElementById('formNavbar').reset();
            document.getElementById('dropdownInputs').innerHTML = '';
            loadNavbarData(); // Reload data
        } else {
            const error = await response.json();
            showAlert('Error: ' + (error.message || 'Gagal menyimpan menu'), 'danger');
        }
    } catch (error) {
        console.error('Error saving navbar:', error);
        showAlert('Error: Gagal menyimpan menu', 'danger');
    }
}

function displayNavbarData(navbars) {
    const tbody = document.getElementById('tabelNavbar');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (navbars.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center">Belum ada menu navbar</td></tr>';
        return;
    }
    
    navbars.forEach((navbar, index) => {
        const row = document.createElement('tr');
        const dropdownMenu = navbar.dropdown_menu ? JSON.parse(navbar.dropdown_menu).join(', ') : '';
        
        row.innerHTML = `
            <td>${navbar.nama_menu}</td>
            <td>${dropdownMenu}</td>
            <td>${navbar.urutan}</td>
            <td class="text-center">
                <button class="btn btn-sm btn-warning me-1" onclick="editNavbar(${navbar.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteNavbar(${navbar.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function addDropdownInput() {
    const container = document.getElementById('dropdownInputs');
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control mb-2';
    input.placeholder = 'Masukkan nama dropdown menu';
    
    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.className = 'btn btn-sm btn-danger ms-2';
    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
    removeBtn.onclick = function() {
        container.removeChild(input);
        container.removeChild(removeBtn);
    };
    
    container.appendChild(input);
    container.appendChild(removeBtn);
}

// ========================================
// DOKUMEN FUNCTIONS
// ========================================

async function loadDokumenData() {
    try {
        const response = await fetch('/admin/dokumens');
        if (response.ok) {
            const dokumens = await response.json();
            displayDokumenData(dokumens);
        }
    } catch (error) {
        console.error('Error loading dokumen data:', error);
    }
}

async function handleDokumenSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('nama', document.getElementById('namaDokumen').value);
    formData.append('keterangan', document.getElementById('keteranganDokumen').value);
    formData.append('kategori', document.getElementById('kategoriDokumen').value);
    
    const fileDokumen = document.getElementById('fileDokumen').files[0];
    if (fileDokumen) {
        formData.append('file', fileDokumen);
    }
    
    try {
        const response = await fetch('/admin/dokumens', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            const result = await response.json();
            showAlert('Dokumen berhasil disimpan!', 'success');
            document.getElementById('formDokumen').reset();
            loadDokumenData(); // Reload data
        } else {
            const error = await response.json();
            showAlert('Error: ' + (error.message || 'Gagal menyimpan dokumen'), 'danger');
        }
    } catch (error) {
        console.error('Error saving dokumen:', error);
        showAlert('Error: Gagal menyimpan dokumen', 'danger');
    }
}

function displayDokumenData(dokumens) {
    const tbody = document.getElementById('tabelDokumen');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (dokumens.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-center">Belum ada dokumen</td></tr>';
        return;
    }
    
    dokumens.forEach((dokumen, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${dokumen.nama}</td>
            <td>${dokumen.keterangan}</td>
            <td>${dokumen.kategori}</td>
            <td>
                <a href="${dokumen.file}" target="_blank" class="btn btn-sm btn-primary">
                    <i class="fas fa-download"></i> Download
                </a>
            </td>
            <td class="text-center">
                <button class="btn btn-sm btn-warning me-1" onclick="editDokumen(${dokumen.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteDokumen(${dokumen.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// ========================================
// UTILITY FUNCTIONS
// ========================================

function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

function showAlert(message, type) {
    // Create alert element
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Add to body
    document.body.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
        }
    }, 5000);
}

// ========================================
// DELETE FUNCTIONS
// ========================================

async function deleteGaleri(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus foto ini?')) return;
    
    try {
        const response = await fetch(`/admin/galeri-fotos/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            showAlert('Foto berhasil dihapus!', 'success');
            loadGaleriData();
        } else {
            showAlert('Error: Gagal menghapus foto', 'danger');
        }
    } catch (error) {
        console.error('Error deleting foto:', error);
        showAlert('Error: Gagal menghapus foto', 'danger');
    }
}

async function deleteCarousel(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus carousel ini?')) return;
    
    try {
        const response = await fetch(`/admin/carousels/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            showAlert('Carousel berhasil dihapus!', 'success');
            loadCarouselData();
        } else {
            showAlert('Error: Gagal menghapus carousel', 'danger');
        }
    } catch (error) {
        console.error('Error deleting carousel:', error);
        showAlert('Error: Gagal menghapus carousel', 'danger');
    }
}

async function deleteNavbar(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus menu ini?')) return;
    
    try {
        const response = await fetch(`/admin/navbars/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            showAlert('Menu berhasil dihapus!', 'success');
            loadNavbarData();
        } else {
            showAlert('Error: Gagal menghapus menu', 'danger');
        }
    } catch (error) {
        console.error('Error deleting navbar:', error);
        showAlert('Error: Gagal menghapus menu', 'danger');
    }
}

async function deleteDokumen(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) return;
    
    try {
        const response = await fetch(`/admin/dokumens/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            showAlert('Dokumen berhasil dihapus!', 'success');
            loadDokumenData();
        } else {
            showAlert('Error: Gagal menghapus dokumen', 'danger');
        }
    } catch (error) {
        console.error('Error deleting dokumen:', error);
        showAlert('Error: Gagal menghapus dokumen', 'danger');
    }
}

// ========================================
// EDIT FUNCTIONS (Placeholder)
// ========================================

function editBerita(id) {
    showAlert('Fitur edit berita akan segera tersedia', 'info');
}

function editGaleri(id) {
    showAlert('Fitur edit galeri akan segera tersedia', 'info');
}

function editCarousel(id) {
    showAlert('Fitur edit carousel akan segera tersedia', 'info');
}

function editNavbar(id) {
    showAlert('Fitur edit navbar akan segera tersedia', 'info');
}

function editDokumen(id) {
    showAlert('Fitur edit dokumen akan segera tersedia', 'info');
}
