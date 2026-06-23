//
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css"; // Ambil CSS bawaan Tom Select
// Daftarkan ke window object agar bisa dipanggil langsung dari file Blade kamu
window.TomSelect = TomSelect;

import "flowbite";
import "flowbite-datepicker";

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css"; // Impor style CSS-nya
import { Indonesian } from "flatpickr/dist/l10n/id.js";
flatpickr.localize(Indonesian); // Set bahasa ke Indonesia
// Inisialisasi ke input yang memiliki id="my-datepicker"
flatpickr("#my-datepicker", {
    static: true, // Agar kalender muncul di bawah input
    altInput: true,
    altFormat: "j F Y", // Ini yang dilihat user (contoh: 12 October 2023)
    dateFormat: "Y-m-d", // Ini yang akan dikirim ke form/database
});
