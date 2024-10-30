// Import Bootstrap JavaScript
import 'bootstrap/dist/js/bootstrap.bundle.min';
import './bootstrap';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-bs5';

// Import jQuery and DataTables
import $ from 'jquery';
import 'datatables.net';

// Make jQuery globally available
window.$ = window.jQuery = $;

// Initialize DataTable
$(function() {
    $('#usersTable').DataTable();
});

// Import Feather icons
import feather from 'feather-icons';

// Your custom JavaScript
document.addEventListener('DOMContentLoaded', () => {
    feather.replace();
});
