import "./bootstrap";

import Alpine from "alpinejs";

// --- IMPORT TOM SELECT ---
import TomSelect from "tom-select";
// -------------------------

window.Alpine = Alpine;

Alpine.start();

// --- INISIALISASI TOM SELECT UNTUK PENCARIAN JABATAN ---
document.addEventListener("DOMContentLoaded", () => {
    const jabatanSelect = document.getElementById("jabatan-select");

    if (jabatanSelect) {
        // Destroy existing instance if any
        if (jabatanSelect.tomselect) {
            jabatanSelect.tomselect.destroy();
        }

        new TomSelect(jabatanSelect, {
            // Opsi Dasar
            create: false, // User tidak bisa membuat jabatan baru
            maxItems: 1, // Hanya bisa memilih satu jabatan

            // Placeholder
            placeholder: "-- Ketik untuk mencari jabatan --",

            // Pengaturan Pencarian
            searchField: ["text"], // Cari berdasarkan text

            // Sorting - Urutkan alfabetis
            sortField: {
                field: "text",
                direction: "asc",
            },

            // Highlight hasil pencarian
            highlight: true,

            // Pesan dan Render Custom
            render: {
                no_results: function (data, escape) {
                    return (
                        '<div class="no-results">Jabatan "' +
                        escape(data.input) +
                        '" tidak ditemukan</div>'
                    );
                },
                option: function (data, escape) {
                    return (
                        '<div class="option-item">' +
                        escape(data.text) +
                        "</div>"
                    );
                },
                item: function (data, escape) {
                    return "<div>" + escape(data.text) + "</div>";
                },
            },

            // Plugin
            plugins: {
                dropdown_input: {}, // Input pencarian di dropdown
                clear_button: {
                    title: "Hapus pilihan",
                    className: "clear-button",
                },
            },

            // Event Handlers
            onInitialize: function () {
                console.log("Tom Select untuk jabatan berhasil diinisialisasi");
            },

            onChange: function (value) {
                if (value) {
                    console.log("Jabatan dipilih:", value);
                    // Hapus error message jika ada
                    const errorDiv = jabatanSelect.parentElement.querySelector(
                        ".text-sm.text-red-600"
                    );
                    if (errorDiv) {
                        errorDiv.style.display = "none";
                    }
                }
            },

            onDropdownOpen: function () {
                // Focus ke input pencarian saat dropdown dibuka
                const dropdownInput = this.dropdown_content.querySelector(
                    ".dropdown-input input"
                );
                if (dropdownInput) {
                    setTimeout(() => dropdownInput.focus(), 10);
                }
            },

            onClear: function () {
                console.log("Pilihan jabatan dihapus");
            },
        });

        // Tambahkan class untuk styling
        jabatanSelect
            .closest(".ts-wrapper")
            .classList.add("tom-select-jabatan");
    } else {
        console.warn('Element dengan ID "jabatan-select" tidak ditemukan');
    }
});
// --------------------------------------------------------
