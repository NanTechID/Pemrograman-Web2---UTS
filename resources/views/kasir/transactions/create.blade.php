@extends('layouts.kasir')

@section('content')

<style>
    /* Allow select dropdowns to expand outside overflow-x-auto container */
    .product-table-wrapper {
        overflow: auto;
    }
    
    .product-table-wrapper table {
        width: 100%;
    }
    
    .product-row {
        position: relative;
    }
    
    .product-row td {
        position: static;
    }
    
    /* Make sure select dropdowns appear above everything */
    .product-row .select {
        position: relative;
        z-index: 20;
        width: 100%;
        min-width: 150px;
        padding: 0.5rem;
        font-size: 0.875rem;
    }
    
    /* Category and Product select specific styling */
    .category-select,
    .product-select {
        width: 100% !important;
        padding: 0.5rem !important;
        overflow: visible !important;
    }
    
    /* When select is active, ensure its dropdown is visible */
    .product-row .select:focus-within {
        z-index: 50;
        position: relative;
    }
    
    .product-row .select optgroup,
    .product-row .select option {
        padding: 8px;
        white-space: normal;
        word-break: break-word;
    }
</style>

@php
        $oldProducts = old('products', [['product_id' => '', 'quantity' => 1]]);
        $categoriesJson = $categories->map(function ($cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->name,
                'products' => $cat->products->map(function ($prod) {
                    return [
                        'id' => $prod->id,
                        'name' => $prod->name,
                        'price' => $prod->price,
                        'stock' => $prod->stock
                    ];
                })
            ];
        });
    @endphp

    <div class="flex items-center justify-between mb-7">
        <h1 class="text-2xl font-semibold">Buat Transaksi Baru</h1>
        <a href="{{ route('kasir.transactions.index') }}" class="btn btn-ghost px-6">Kembali</a>
    </div>

    <div class="mb-4">
        <button type="button" class="btn btn-sm btn-success" onclick="document.getElementById('modal-add-member').showModal()">+ Tambah Member</button>
    </div>

    @if ($errors->any())
        <div class="alert alert-error mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('kasir.transactions.store') }}">
        @csrf

        <div class="grid gap-4 md:grid-cols-2 mb-6">
            <div class="form-control">
                <label class="label"><span class="label-text">Jenis Pelanggan</span></label>
                <select id="customer-type-select" name="customer_type" class="select select-bordered w-full">
                    <option value="Umum">Umum</option>
                    <option value="Member">Member</option>
                </select>
            </div>

            <div id="customer-member-search-field" style="display:none;">
                <div class="form-control">
                    <label class="label"><span class="label-text">Cari Member</span></label>
                    <select id="customer-select" name="customer_id" class="select select-bordered w-full">
                        <option value="">-- Pilih Member --</option>
                        @foreach ($customers as $customer)
                            @if($customer->customer_type === 'Member')
                            <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>{{ $customer->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="customer-umum-field" class="form-control">
                <label class="label"><span class="label-text">Nama Pelanggan</span></label>
                <input type="text" name="customer_name" placeholder="Masukkan nama pelanggan" class="input input-bordered w-full" value="{{ old('customer_name', '') }}" />
            </div>
        </div>

        <h2 class="text-lg font-semibold mb-4">Pilih Produk</h2>
        <div class="overflow-x-auto mb-4 product-table-wrapper">
            <table class="table w-full text-sm">
                <thead>
                    <tr>
                        <th class="min-w-48">Kategori</th>
                        <th class="min-w-56">Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="product-rows">
                    @foreach ($oldProducts as $index => $oldProduct)
                        @php
                            $selected = $products->firstWhere('id', $oldProduct['product_id'] ?? null);
                        @endphp
                        <tr class="product-row">
                            <td class="min-w-48">
                                <select name="products[{{ $index }}][category_id]" class="select select-bordered w-full category-select" required>
                                    <option value="">-- Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old("products.$index.category_id") == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="min-w-56">
                                <select name="products[{{ $index }}][product_id]" class="select select-bordered w-full product-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @if(isset($oldProduct['product_id']))
                                        @php $oldProd = $products->flatMap->products->firstWhere('id', $oldProduct['product_id']); @endphp
                                        @if($oldProd)
                                        <option value="{{ $oldProd->id }}" data-price="{{ $oldProd->price }}" data-stock="{{ $oldProd->stock }}" selected>
                                            {{ $oldProd->name }}
                                        </option>
                                        @endif
                                    @endif
                                </select>
                            </td>
                            <td class="product-price text-sm whitespace-nowrap">Rp {{ number_format($selected?->price ?? 0, 0, ',', '.') }}</td>
                            <td class="product-stock text-sm whitespace-nowrap">{{ $selected?->stock ?? '-' }}</td>
                            <td class="whitespace-nowrap">
                                <input
                                    type="number"
                                    name="products[{{ $index }}][quantity]"
                                    min="1"
                                    value="{{ $oldProduct['quantity'] ?? 1 }}"
                                    class="input input-bordered input-sm w-16"
                                    required
                                />
                            </td>
                            <td class="product-subtotal text-sm font-semibold whitespace-nowrap">Rp 0</td>
                            <td class="whitespace-nowrap">
                                <button type="button" class="btn btn-xs btn-error btn-remove-row">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="grid gap-3 md:grid-cols-3 mb-6">
            <div class="stats shadow md:col-span-2">
                <div class="stat">
                    <div class="stat-title">Total Qty</div>
                    <div id="summary-total-qty" class="stat-value text-primary text-2xl">0</div>
                </div>
                <div class="stat">
                    <div class="stat-title">Subtotal Belanja</div>
                    <div id="summary-subtotal" class="stat-value text-secondary text-2xl">Rp 0</div>
                </div>
                <div class="stat">
                    <div class="stat-title">Estimasi Diskon</div>
                    <div id="summary-discount" class="stat-value text-accent text-2xl">Rp 0</div>
                </div>
            </div>
            <div class="card bg-base-100 border border-base-200 shadow">
                <div class="card-body p-4">
                    <p class="text-sm text-base-content/70">Total Bayar</p>
                    <p id="summary-grand-total" class="text-3xl font-bold text-primary">Rp 0</p>
                    <p id="discount-note" class="text-xs text-base-content/60">Diskon 2% berlaku untuk subtotal di atas Rp 200.000</p>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-7">
            <button type="button" id="btn-add-product" class="btn btn-success font-bold px-8 py-3 text-white shadow-lg border-2 border-green-600 hover:bg-green-700 hover:border-green-700 transition-all text-lg">Tambah Produk</button>
        </div>

        <div class="pt-2">
            <button type="submit" class="btn btn-primary px-8">Simpan Transaksi</button>
        </div>
    </form>

    <!-- Modal Tambah Member -->
    <dialog id="modal-add-member" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">Tambah Member Baru</h3>
            <form id="form-add-member">
                @csrf
                <div class="form-control mb-2">
                    <label class="label"><span class="label-text">Nama</span></label>
                    <input type="text" name="name" class="input input-bordered w-full" required />
                </div>
                <div class="form-control mb-2">
                    <label class="label"><span class="label-text">No. HP</span></label>
                    <input type="text" name="phone" class="input input-bordered w-full" />
                </div>
                <div class="form-control mb-2">
                    <label class="label"><span class="label-text">Email</span></label>
                    <input type="email" name="email" class="input input-bordered w-full" />
                </div>
                <div class="form-control mb-4">
                    <label class="label"><span class="label-text">Alamat</span></label>
                    <textarea name="address" class="textarea textarea-bordered w-full"></textarea>
                </div>
                <div class="modal-action">
                    <button type="button" class="btn" onclick="document.getElementById('modal-add-member').close()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            <div id="add-member-success" class="alert alert-success mt-2 hidden"></div>
            <div id="add-member-error" class="alert alert-error mt-2 hidden"></div>
        </div>
    </dialog>

    <template id="product-row-template">
        <tr class="product-row">
            <td class="min-w-48">
                <select class="select select-bordered w-full category-select" required>
                    <option value="">-- Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="min-w-56">
                <select class="select select-bordered w-full product-select" required>
                    <option value="">-- Pilih Produk --</option>
                </select>
            </td>
            <td class="product-price text-sm whitespace-nowrap">Rp 0</td>
            <td class="product-stock text-sm whitespace-nowrap">-</td>
            <td class="whitespace-nowrap">
                <input type="number" min="1" value="1" class="input input-bordered input-sm w-16" required />
            </td>
            <td class="product-subtotal text-sm font-semibold whitespace-nowrap">Rp 0</td>
            <td class="whitespace-nowrap">
                <button type="button" class="btn btn-xs btn-error btn-remove-row">Hapus</button>
            </td>
        </tr>
    </template>

<script>
    window.categoriesData = @json($categoriesJson);
    
    document.addEventListener('DOMContentLoaded', function () {
        // --- Customer Type Toggle ---
        const typeSelect = document.getElementById('customer-type-select');
        const memberField = document.getElementById('customer-member-search-field');
        const umumField = document.getElementById('customer-umum-field');
        const customerSelect = document.getElementById('customer-select');
        const customerNameInput = umumField.querySelector('input[name="customer_name"]');

        function toggleCustomerFields() {
            if (typeSelect.value === 'Member') {
                memberField.style.display = '';
                umumField.style.display = 'none';
                customerNameInput.value = ''; // Clear umum name when switching to Member
                customerNameInput.removeAttribute('required');
            } else {
                memberField.style.display = 'none';
                umumField.style.display = '';
                customerSelect.value = ''; // Clear member select when switching to Umum
                customerNameInput.setAttribute('required', 'required');
            }
            updateDiscountNote();
        }
        
        function updateDiscountNote() {
            const discountNote = document.getElementById('discount-note');
            if (typeSelect.value === 'Member') {
                discountNote.textContent = '💎 Member: Diskon otomatis 5% untuk semua transaksi';
                discountNote.classList.add('text-info', 'font-semibold');
                discountNote.classList.remove('text-base-content/60');
            } else {
                discountNote.textContent = 'Diskon 2% berlaku untuk subtotal di atas Rp 200.000';
                discountNote.classList.remove('text-info', 'font-semibold');
                discountNote.classList.add('text-base-content/60');
            }
        }
        
        typeSelect.addEventListener('change', toggleCustomerFields);
        toggleCustomerFields();

        // --- Produk Logic ---
        const rowsContainer = document.getElementById('product-rows');
        const addButton = document.getElementById('btn-add-product');
        const template = document.getElementById('product-row-template');
        const summaryTotalQty = document.getElementById('summary-total-qty');
        const summarySubtotal = document.getElementById('summary-subtotal');
        const summaryDiscount = document.getElementById('summary-discount');
        const summaryGrandTotal = document.getElementById('summary-grand-total');

        function formatRupiah(value) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value || 0);
        }

        function updateRowInfo(row) {
            const select = row.querySelector('.product-select');
            const qtyInput = row.querySelector('input[type="number"]');
            const selectedOption = select.options[select.selectedIndex];
            const price = Number(selectedOption?.dataset.price || 0);
            const stock = selectedOption?.dataset.stock || '-';
            const qty = Number(qtyInput.value || 0);
            const subtotal = price * qty;

            row.querySelector('.product-price').textContent = formatRupiah(price);
            row.querySelector('.product-stock').textContent = stock;
            row.querySelector('.product-subtotal').textContent = formatRupiah(subtotal);

            updateSummary();
        }

        function updateSummary() {
            let totalQty = 0;
            let subtotal = 0;

            rowsContainer.querySelectorAll('.product-row').forEach((row) => {
                const select = row.querySelector('.product-select');
                const selectedOption = select.options[select.selectedIndex];
                const price = Number(selectedOption?.dataset.price || 0);
                const qty = Number(row.querySelector('input[type="number"]').value || 0);

                if (select.value) {
                    totalQty += qty;
                    subtotal += price * qty;
                }
            });

            const discount = subtotal > 200000 ? subtotal * 0.02 : 0;
            const grandTotal = subtotal - discount;

            summaryTotalQty.textContent = totalQty;
            summarySubtotal.textContent = formatRupiah(subtotal);
            summaryDiscount.textContent = formatRupiah(discount);
            summaryGrandTotal.textContent = formatRupiah(grandTotal);
        }

function reindexRows() {
            rowsContainer.querySelectorAll('.product-row').forEach((row, index) => {
                const categorySelect = row.querySelector('.category-select');
                const productSelect = row.querySelector('.product-select');
                const qtyInput = row.querySelector('input[type="number"]');

                if (categorySelect) categorySelect.name = `products[${index}][category_id]`;
                if (productSelect) productSelect.name = `products[${index}][product_id]`;
                if (qtyInput) qtyInput.name = `products[${index}][quantity]`;
            });
        }

function attachRowEvents(row) {
            const categorySelect = row.querySelector('.category-select');
            const productSelect = row.querySelector('.product-select');
            const qtyInput = row.querySelector('input[type="number"]');
            const btnRemove = row.querySelector('.btn-remove-row');

            // Category change handler
            if (categorySelect) {
                categorySelect.addEventListener('change', function () {
                    const catId = this.value;
                    productSelect.innerHTML = '<option value="">-- Pilih Produk --</option>';
                    if (catId) {
                        const catData = window.categoriesData.find(cat => cat.id == catId);
                        if (catData && catData.products.length) {
                            catData.products.forEach(prod => {
                                const option = document.createElement('option');
                                option.value = prod.id;
                                option.dataset.price = prod.price;
                                option.dataset.stock = prod.stock;
                                option.textContent = prod.name;
                                productSelect.appendChild(option);
                            });
                        }
                    }
                    productSelect.value = '';
                    updateRowInfo(row);
                });
            }

            // Product change handler
            if (productSelect) {
                productSelect.addEventListener('change', function () {
                    updateRowInfo(row);
                });
            }

            if (qtyInput) {
                qtyInput.addEventListener('input', function () {
                    updateRowInfo(row);
                });
            }

            if (btnRemove) {
                btnRemove.addEventListener('click', function (e) {
                    e.preventDefault();
                    const totalRows = rowsContainer.querySelectorAll('.product-row').length;
                    if (totalRows === 1) {
                        if (productSelect) productSelect.value = '';
                        if (qtyInput) qtyInput.value = 1;
                        updateRowInfo(row);
                        return;
                    }
                    row.remove();
                    reindexRows();
                    updateSummary();
                });
            }
        }

        if (addButton) {
            addButton.addEventListener('click', function (e) {
                e.preventDefault();
                const newRow = template.content.firstElementChild.cloneNode(true);
                rowsContainer.appendChild(newRow);
                attachRowEvents(newRow);
                reindexRows();
                updateRowInfo(newRow);
            });
        }

        // Attach events to existing rows
        if (rowsContainer) {
            rowsContainer.querySelectorAll('.product-row').forEach((row) => {
                attachRowEvents(row);
            });
            setTimeout(() => {
                rowsContainer.querySelectorAll('.product-row').forEach((row) => {
                    updateRowInfo(row);
                });
            }, 0);
        }

        reindexRows();
        updateSummary();

        // --- Add Member Form ---
        const formAddMember = document.getElementById('form-add-member');
        const successDiv = document.getElementById('add-member-success');
        const errorDiv = document.getElementById('add-member-error');

        if (formAddMember) {
            formAddMember.addEventListener('submit', async function (e) {
                e.preventDefault();

                successDiv.classList.add('hidden');
                errorDiv.classList.add('hidden');

                const formData = new FormData(this);

                try {
                    const res = await fetch('{{ route('kasir.customers.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const json = await res.json();

                    if (res.ok && json.success) {
                        // Tambahkan ke select pelanggan
                        const select = document.getElementById('customer-select');
                        const opt = document.createElement('option');
                        opt.value = json.customer.id;
                        opt.textContent = json.customer.name;
                        opt.selected = true;
                        select.appendChild(opt);

                        successDiv.textContent = 'Member berhasil ditambahkan!';
                        successDiv.classList.remove('hidden');
                        formAddMember.reset();

                        setTimeout(() => {
                            document.getElementById('modal-add-member').close();
                        }, 1000);
                    } else {
                        errorDiv.textContent = json.message || 'Gagal menambah member.';
                        errorDiv.classList.remove('hidden');
                    }
                } catch (error) {
                    errorDiv.textContent = 'Terjadi kesalahan: ' + error.message;
                    errorDiv.classList.remove('hidden');
                }
            });
        }
    });
    </script>
@endsection

