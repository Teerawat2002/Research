import './bootstrap';

import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css"; // Import CSS ของ Flatpickr

// เริ่มต้น Alpine.js
window.Alpine = Alpine;
Alpine.start();

// เริ่มต้น Flatpickr เมื่อ DOM โหลดเสร็จ
document.addEventListener("DOMContentLoaded", function () {
    const startPicker = flatpickr("#datepicker-range-start", {
        dateFormat: "Y-m-d", // รูปแบบวันที่ (เช่น 2024-12-01)
        onChange: function (selectedDates, dateStr) {
            endPicker.set("minDate", dateStr); // กำหนด minDate สำหรับ end_date
        },
    });

    const endPicker = flatpickr("#datepicker-range-end", {
        dateFormat: "Y-m-d", // รูปแบบวันที่
        onChange: function (selectedDates, dateStr) {
            startPicker.set("maxDate", dateStr); // กำหนด maxDate สำหรับ start_date
        },
    });
});
