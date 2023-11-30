let hamMenuIcon = document.getElementById("ham-menu");
let navBar = document.getElementById("nav-bar");
let navLinks = navBar.querySelectorAll("li");

hamMenuIcon.addEventListener("click", () => {
  navBar.classList.toggle("active");
  hamMenuIcon.classList.toggle("fa-times");
});
navLinks.forEach((navLinks) => {
  navLinks.addEventListener("click", () => {
    navBar.classList.remove("active");
    hamMenuIcon.classList.toggle("fa-times");
  });
});

//user icon
function menuToggle(){
  const toggleMenu = document.querySelector('.menu');
  toggleMenu.classList.toggle('active')
}

// delete confirm check
function deleteProfile() {
  if (confirm("Are you sure you want to delete your profile?")) {
      return true;
  } else {
      return false;
  }
}


function editProfile() {
  const displayInfos = document.querySelectorAll(".display-info");
  displayInfos.forEach((info) => {
    const editInput = document.createElement("input");
    editInput.setAttribute("type", "text");
    editInput.setAttribute("value", info.textContent);
    info.textContent = "";
    info.appendChild(editInput);
  });

  const profileButton = document.querySelector(".profile-button");
  profileButton.textContent = "Save";
  profileButton.removeEventListener("click", editProfile);
  profileButton.addEventListener("click", saveProfile);
}

$(document).ready(function() {
  // pops out the add form for inventory
  $('#add-btn-inventory').click(function() {
      $('#add-form-inventory').toggle();
  });
});
$(document).ready(function() {
  // pops out the add form for item
  $('#add-btn-item').click(function() {
      $('#add-form-item').toggle();
  });
});
$(document).ready(function() {
  // pops out the add form for report
  $('#add-btn-report').click(function() {
      $('#add-form-report').toggle();
  });
});


// varchar number
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
  return true;
}


//purchase item update button
$(document).ready(function() {
  // Click event for the update button
  $('.update-button').click(function() {
      // Get the data ID attribute
      var id = $(this).data('id');

      // Get the corresponding record data
      var itemName = $(this).closest('tr').find('td:nth-child(2)').text();
      var qty = $(this).closest('tr').find('td:nth-child(3)').text();
      var supplierName = $(this).closest('tr').find('td:nth-child(4)').text();
      var supplierContact = $(this).closest('tr').find('td:nth-child(5)').text();
      var supplierAddress = $(this).closest('tr').find('td:nth-child(6)').text();

      // Set the form values with the record data
      $('#id').val(id);
      $('#Item_Name').val(itemName);
      $('input[name="Qty"]').val(qty);
      $('#Supplier_Name').val(supplierName);
      $('#Supplier_Contact').val(supplierContact);
      $('#Supplier_Address').val(supplierAddress);

      // Show the form
      $('#form-container-inventory').show();
  });
});


//create order remove button
var orderCount = 1;

function createOrderForm() {
    orderCount++;

    var container = document.getElementById('order-container');

    var form = document.createElement('div');
    form.classList.add('order-form');
    form.id = `order-form-${orderCount}`;
    form.innerHTML = `
        <h3>Order ${orderCount}</h3>
        <div class="form-row">
            <label for="item-name-${orderCount}">Item Name:</label>
            <select id="item-name-${orderCount}" name="item-name-${orderCount}">
                <?php include 'php/order_read.php'; ?>
            </select>
        </div>
        <div class="form-row">
            <label for="qty-${orderCount}">Qty:</label>
            <input type="text" id="qty-${orderCount}" name="qty-${orderCount}">
        </div>
        <div class="form-row">
            <label for="supplier-name-${orderCount}">Supplier Name:</label>
            <input type="text" id="supplier-name-${orderCount}" name="supplier-name-${orderCount}">
        </div>
        <div class="form-row">
            <label for="supplier-contact-${orderCount}">Supplier Contact:</label>
            <input type="text" id="supplier-contact-${orderCount}" name="supplier-contact-${orderCount}" pattern="[0-9]+" title="Only numbers allowed">
        </div>
        <div class="form-row">
            <label for="supplier-address-${orderCount}">Supplier Address:</label>
            <input type="text" id="supplier-address-${orderCount}" name="supplier-address-${orderCount}">
        </div>
        <button class="remove-button" onclick="removeOrderForm(${orderCount})">Remove</button>
    `;

    container.insertBefore(form, container.lastElementChild.previousElementSibling);

    document.getElementById('order-count').value = orderCount;
}
    function removeOrderForm(orderId) {
        var form = document.getElementById(`order-form-${orderId}`);

        // Disable the input fields of the removed order
        var inputs = form.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
        }

        var selects = form.getElementsByTagName('select');
        for (var i = 0; i < selects.length; i++) {
        selects[i].disabled = true;
        }

        // Remove the remove button
        var removeButton = form.getElementsByClassName('remove-button')[0];
        removeButton.parentNode.removeChild(removeButton);

        orderCount--;
        document.getElementById('order-count').value = orderCount;
    }