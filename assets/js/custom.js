
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('employeeTable');
    const searchInput = document.getElementById('searchInput');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const itemsPerPage = 5;
    let currentPage = 1;

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredRows = rows.filter(row => {
            return Array.from(row.cells).some(cell => 
                cell.textContent.toLowerCase().includes(searchTerm)
            );
        });
        displayRows(filteredRows);
        setupPagination(filteredRows);
    }

    function displayRows(rowsToDisplay) {
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedRows = rowsToDisplay.slice(start, end);

        tbody.innerHTML = '';
        paginatedRows.forEach(row => tbody.appendChild(row));
    }

    function setupPagination(rowsToDisplay) {
        const pageCount = Math.ceil(rowsToDisplay.length / itemsPerPage);
        const paginationElement = document.getElementById('pagination');
        paginationElement.innerHTML = '';

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement('button');
            btn.innerText = i;
            btn.classList.add('mx-1', 'px-3', 'py-1', 'bg-blue-500', 'text-white', 'rounded');
            btn.addEventListener('click', () => {
                currentPage = i;
                displayRows(rowsToDisplay);
            });
            paginationElement.appendChild(btn);
        }
    }

    searchInput.addEventListener('input', filterTable);
    filterTable(); // Initial display
});

// employee form validation
jQuery("#ems_add_Employee_Form").validate();
