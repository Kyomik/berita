    <script defer>
    	const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

function toggleSubMenu(event) {
    event.preventDefault();
    const parentLi = event.target.closest('li');
    parentLi.classList.toggle('show-sub-menu');
}

//kategori manage

try{
  let selectedButton = null;
  let initialCategories = [];
  let deleteIds = [];

  const SAVE_CHANGES_BTN_ID = 'save-changes-btn';
  const SAVE_CANCEL_BTN_ID = 'save-cancel-btn';
  const DELETE_KATEGORI_BTN_ID = 'delete-kategori-btn';
  const MODAL_EDIT_ID = '#modal-edit';
  const MODAL_TAMBAH_ID = '#modal-tambah';

  function getLastId() {
    let maxId = 0;
    document.querySelectorAll('.kategori-btn').forEach(button => {
      const id = parseInt(button.getAttribute('data-id'), 10);
      if (id > maxId) {
        maxId = id;
      }
    });
    return maxId;
  }

  // Menyimpan data kategori awal saat halaman dimuat
  document.querySelectorAll('.kategori-btn').forEach(button => {
    initialCategories.push({
      id: button.getAttribute('data-id'),
      text: button.textContent.trim()
    });
  });

  // Menampilkan tombol "Save Changes" dan "Cancel ALL"
  function showSaveChangesButtons() {
    document.getElementById(SAVE_CHANGES_BTN_ID).classList.remove('d-none');
    document.getElementById(SAVE_CANCEL_BTN_ID).classList.remove('d-none');
  }

  // Menyembunyikan tombol "Save Changes" dan "Cancel ALL"
  function hideSaveChangesButtons() {
    document.getElementById(SAVE_CHANGES_BTN_ID).classList.add('d-none');
    document.getElementById(SAVE_CANCEL_BTN_ID).classList.add('d-none');
  }

  // Mengembalikan kategori ke keadaan semula
  function cancelAllChanges() {
    const dataKategori = document.querySelector('.data-kategori');

    // Hapus semua kategori yang ada
    document.querySelectorAll('.kategori-btn').forEach(button => {
      button.remove();
    });

    // Tambahkan kembali kategori dari initialCategories
    initialCategories.forEach(category => {
      const newButton = createCategoryButton(category.id, category.text);
      const tambahKategoriPlaceholder = document.getElementById('tambah-kategori-placeholder');
      dataKategori.insertBefore(newButton, tambahKategoriPlaceholder);
    });

    // Reset tombol "Cancel ALL" dan "Save Changes"
    hideSaveChangesButtons();
    deleteIds = [];  // Kosongkan array deleteIds
  }

  // Cek apakah kategori ada di initialCategories
  function isInitialCategory(id) {
    return initialCategories.some(category => category.id === id);
  }

  function createCategoryButton(id, text) {
    const newButton = document.createElement('button');
    newButton.type = 'button';
    newButton.className = 'btn btn-primary kategori-btn';
    newButton.setAttribute('data-id', id);
    newButton.setAttribute('data-toggle', 'modal');
    newButton.setAttribute('data-target', MODAL_EDIT_ID);
    newButton.textContent = text;

    newButton.addEventListener('click', function() {
      selectedButton = this;
      document.getElementById('editable-input').value = this.textContent.trim();
    });

    return newButton;
  }

  // Event listener untuk tombol delete yang berubah menjadi cancel
  document.getElementById(DELETE_KATEGORI_BTN_ID).addEventListener('click', function() {
    const deleteButton = document.getElementById(DELETE_KATEGORI_BTN_ID);
    if (deleteButton.textContent.trim() === 'Delete') {
      document.querySelectorAll('.kategori-btn').forEach(button => {
        button.classList.remove('btn-primary');
        button.classList.add('btn-danger');
        button.setAttribute('data-target', '');  // Hapus data-target
      });

      deleteButton.textContent = 'Cancel';
    } else {
      document.querySelectorAll('.kategori-btn').forEach(button => {
        button.classList.remove('btn-danger');
        button.classList.add('btn-primary');
        button.setAttribute('data-target', MODAL_EDIT_ID);
      });

      deleteButton.textContent = 'Delete';
    }
  });

  // Pilih tombol kategori dan tambahkan event listener
  document.querySelector('.data-kategori').addEventListener('click', function(event) {
    if (event.target.classList.contains('kategori-btn') && event.target.classList.contains('btn-danger')) {
      const kategoriText = event.target.textContent.trim();
      const confirmDelete = confirm(`Apakah Anda yakin ingin menghapus kategori "${kategoriText}"?`);
      if (confirmDelete) {
        const id = event.target.getAttribute('data-id');
        if (isInitialCategory(id)) {
          deleteIds.push(id);  // Simpan id kategori yang dihapus jika ada di initialCategories
        }
        event.target.remove();
        showSaveChangesButtons();  // Tampilkan tombol "Save Changes" dan "Cancel ALL"
      }
    } else if (event.target.classList.contains('kategori-btn')) {
      selectedButton = event.target;
      document.getElementById('editable-input').value = selectedButton.textContent.trim();
    }
  });

  // Event listener untuk mengedit kategori
  document.getElementById('edit-kategori-btn').addEventListener('click', function() {
    if (selectedButton) {
      const newKategoriText = document.getElementById('editable-input').value.trim();
      selectedButton.textContent = newKategoriText;
      $(MODAL_EDIT_ID).modal('hide');
      showSaveChangesButtons();  // Tampilkan tombol "Save Changes" dan "Cancel ALL"
    }
  });

  // Event listener untuk menambah kategori baru
  document.getElementById('tambah-kategori-btn').addEventListener('click', function() {
    let nextId = getLastId();
    const inputKategori = document.getElementById('input-kategori');
    const kategori = inputKategori.value.trim();
    if (kategori) {
      const dataKategori = document.querySelector('.data-kategori');
      const newButton = createCategoryButton(nextId += 1, kategori);
      const tambahKategoriPlaceholder = document.getElementById('tambah-kategori-placeholder');
      dataKategori.insertBefore(newButton, tambahKategoriPlaceholder);

      inputKategori.value = ''; // Reset input field
      $(MODAL_TAMBAH_ID).modal('hide'); // Hide modal
      showSaveChangesButtons();  // Tampilkan tombol "Save Changes" dan "Cancel ALL"
    } else {
      alert("Nama kategori tidak boleh kosong.");
    }
  });

  // Event listener untuk tombol Save Changes
  document.getElementById(SAVE_CHANGES_BTN_ID).addEventListener('click', function() {
    const kategoriData = [];
    document.querySelectorAll('.data-kategori .kategori-btn').forEach(button => {
      kategoriData.push({ id_kategori: button.getAttribute('data-id'), nama_kategori: button.textContent.trim() });
    });

    fetch('{{ route("admin/kategori/manage") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // Tambahkan token CSRF
      },
      body: JSON.stringify({ categories: kategoriData, deletedCategories: deleteIds })  // Tambahkan deleteIds ke payload
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      if (data.message == "success") {
        console.log(data)
        // alert('Changes saved successfully!');
        hideSaveChangesButtons();  // Sembunyikan tombol "Save Changes" dan "Cancel ALL"
        deleteIds = [];  // Kosongkan array deleteIds setelah penyimpanan
      } else {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred while saving changes.');
    });

  });

  // Event listener untuk tombol Cancel ALL
  document.getElementById(SAVE_CANCEL_BTN_ID).addEventListener('click', cancelAllChanges);
}catch(error){

}

  try{
    const addParagrafButton = document.getElementById('addParagrafButton');
    const paragrafContainer = document.getElementById('paragrafContainer');
    let paragrafCount = paragrafContainer.querySelector('.form-group').querySelectorAll('.form-control').length
    const cancelButton = document.getElementById('batalButton');
     const formUpload = document.getElementById('formUpload');
     const formEdit = document.getElementById('formEdit');
    const judulInput = document.getElementById('judulInput');

    addParagrafButton.addEventListener('click', function () {
        paragrafCount++;
        const newParagraf = document.createElement('div');
        newParagraf.classList.add('form-group');
        newParagraf.innerHTML = `
            <label>Paragraf ${paragrafCount}</label>
            <input type="hidden" name="id_paragraf[]">
            <textarea class="form-control" rows="3" name="paragraf[]" id="paragraf${paragrafCount}"></textarea>
        `;
        paragrafContainer.appendChild(newParagraf);
    });

    cancelButton.addEventListener('click', function () {
        if (confirm('Apakah Anda yakin ingin membatalkannya?')) {
            const allParagrafs = paragrafContainer.querySelectorAll('.form-group');
            allParagrafs.forEach(function (paragraf, index) {
                if (index > 0) { // Keep the first textarea
                    paragraf.remove();
                } else {
                    paragraf.querySelector('textarea').value = ''; // Clear the first textarea
                }
            });

            // Reset paragraph count
            paragrafCount = 1;
            judulInput.value = '';
            const checkboxes = document.querySelectorAll('.btn-group-toggle input[type="checkbox"]');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false;
                checkbox.closest('label').classList.remove('active');
            });
        }
    });


    formUpload.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        fetchFeatures('Apakah Anda yakin ingin mengirimkan berita ini?', this)
        
    });

    // formEdit.addEventListener('submit', function (event) {
    //     event.preventDefault(); // Prevent the default form submission
    //     fetchFeatures('Apakah Anda yakin ingin mengedit berita ini?', this)
        
    // });
}catch(error
  ){
  
}
function fetchFeatures(message, form){
      if (confirm(message)) {
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Menambahkan header ini agar Laravel tahu itu adalah AJAX request
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Terjadi kesalahan saat mengirim data.');
                }
            })
            .then(data => {
                if (data.redirect) {
                    window.location.href = `${data.redirect}?status=success` ;
                }
            })
            .catch(error => {
                alert(error.message);
            });
        }
    }
try{
  document.getElementById('submitEdit').addEventListener('click', function(event){
    // event.preventDefault()
        fetchFeatures('Apakah Anda yakin ingin mengedit berita ini?', formEdit)
      })
}catch(err){

}
try{
    const loader = document.querySelector("#loading");
    document.getElementById('toggle-komentar').addEventListener('click', function() {
        const beritaId = document.querySelector('.container-admin').id;

        const komentarSection = document.querySelector('.container-komentar');
        if (komentarSection.style.display === 'none' || komentarSection.style.display === '') {
            komentarSection.style.display = 'block';
            getKomentar(beritaId);
        } else {
            komentarSection.style.display = 'none';
        }
    });
}catch(error){

}

// showing loading
function displayLoading() {
    loader.classList.add("display");
    // to stop loading after some time
    setTimeout(() => {
        loader.classList.remove("display");
    }, 5000);
}

// hiding loading 
function hideLoading() {
    loader.classList.remove("display");
}

async function getKomentar(beritaId) {
    

    const komentarList = document.getElementById('komentar-list');

    try {
        displayLoading();
        // Fetch data from API
        const response = await fetch(`{{ url('api/komentar') }}/${beritaId}`);
        const data = await response.json();
        
        // Kosongkan daftar komentar sebelumnya
        komentarList.innerHTML = ''; 

        // Append new comments
        data.forEach(komentar => {
            const komentarCard = document.createElement('div');
            komentarCard.className = 'card mb-4';

            komentarCard.innerHTML = `
                <div class="card-body">
                    <p>${komentar.isi_komentar}</p>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <img src="" alt="avatar" width="25" height="25" />
                            <p class="small mb-0 ms-2">${komentar.user}</p>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <p class="small text-muted mb-0">${komentar.tanggal_komentar}</p>
                            <i class="far fa-thumbs-up mx-2 fa-xs text-body" style="margin-top: -0.16rem;"></i>
                        </div>
                    </div>
                </div>
            `;
            komentarList.appendChild(komentarCard);
        });
    } catch (error) {
        console.error('Error fetching comments:', error);
    } finally {
        // Sembunyikan spinner setelah data diterima
        hideLoading()
    }
}
  try{
    document.querySelector('.features').addEventListener('click', (event) => {
        // Cek apakah target dari event adalah tombol `btnKomentar`
        if (event.target.classList.contains('btnKomentar')) {
            // Ambil id_berita dari data-id attribute pada tombol yang diklik
            const idBerita = event.target.getAttribute('data-id');
            
            // Setel id_berita ke modal
            getKomentar(idBerita);            
        }
    });
  }catch(err){

  }


    </script>
</body>
</html>