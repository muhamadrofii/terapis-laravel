@extends('layouts.admin')

@section('title', 'Daftar Pesanan Produk - Terapis Online Admin')

@section('content')
<div class="d-flex flex-column gap-1 mb-4">
    <h1 class="fw-bold text-dark" style="font-size: 2.25rem;">Daftar Pesanan Produk</h1>
    <p class="text-secondary">Kelola pesanan suplemen herbal pasien, periksa bukti transfer QRIS, dan perbarui status pengiriman.</p>
</div>

<div class="bg-white p-4 rounded-4 border shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr class="text-muted small">
                    <th>ID & Waktu</th>
                    <th>Pelanggan</th>
                    <th>Produk & Jumlah</th>
                    <th>Total Tagihan</th>
                    <th>Info Pengiriman</th>
                    <th>Bukti Pembayaran</th>
                    <th>Status Pesanan</th>
                    <th class="text-end">Perbarui Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="small text-secondary">
                        <span class="fw-bold text-dark">#{{ substr($order->id, 0, 8) }}</span><br>
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </td>
                    <td>
                        <div class="fw-bold text-dark">{{ $order->user ? $order->user->name : 'Guest' }}</div>
                        <span class="text-muted small">{{ $order->user ? $order->user->email : '' }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $order->product->image }}" alt="{{ $order->product->name }}" class="rounded border" style="width: 40px; height: 40px; object-fit: cover;">
                            <div>
                                <span class="fw-semibold text-dark">{{ $order->product->name }}</span><br>
                                <span class="text-secondary small">{{ $order->quantity }} pcs</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold text-purple" style="color: #5E2CB5;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        <span class="text-muted small" style="font-size: 0.72rem;">${{ number_format(($order->product->price_usd * $order->quantity), 2) }}</span>
                    </td>
                    <td class="small text-secondary">
                        <strong>WA:</strong> +62{{ $order->whatsapp_number }}<br>
                        <strong>Alamat:</strong> <span class="d-inline-block text-truncate" style="max-width: 200px;" title="{{ $order->shipping_address }}">{{ $order->shipping_address }}</span>
                    </td>
                    <td>
                        @if($order->payment_proof)
                            <a href="/{{ $order->payment_proof }}" target="_blank" class="btn btn-outline-success btn-sm rounded-3 py-1 px-2.5 small fw-bold d-inline-flex align-items-center gap-1">
                                <i class="bi bi-file-earmark-image"></i> Lihat Resi
                            </a>
                        @else
                            <span class="badge bg-light text-secondary border">Belum Upload</span>
                        @endif
                    </td>
                    <td>
                        <!-- Status Badge -->
                        @if($order->status === 'completed')
                            <span class="badge bg-success-subtle text-success px-2 py-1 rounded-2">Selesai / Dikirim</span>
                        @elseif($order->status === 'accepted')
                            <span class="badge bg-info-subtle text-info px-2 py-1 rounded-2">Dikonfirmasi</span>
                        @elseif($order->status === 'cancelled')
                            <span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-2">Dibatalkan</span>
                        @else
                            <span class="badge bg-warning-subtle text-warning px-2 py-1 rounded-2">Menunggu Pembayaran</span>
                        @endif

                        <div class="mt-1">
                            @if($order->payment_status === 'paid')
                                <span class="badge bg-success text-white" style="font-size: 0.65rem;">LUNAS</span>
                            @else
                                <span class="badge bg-secondary text-white" style="font-size: 0.65rem;">BELUM BAYAR</span>
                            @endif
                        </div>
                    </td>
                    <td class="text-end">
                        <!-- Inline Update Form -->
                        <form action="{{ route('admin.products.order_status', $order->id) }}" method="POST" class="d-inline-flex gap-1 justify-content-end align-items-center">
                            @csrf
                            <select name="status" class="form-select form-select-sm rounded-3 bg-light border-0 small" style="width: 120px; font-size: 0.8rem;">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ $order->status === 'accepted' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai / Kirim</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Batal</option>
                            </select>

                            <select name="payment_status" class="form-select form-select-sm rounded-3 bg-light border-0 small" style="width: 100px; font-size: 0.8rem;">
                                <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Lunas</option>
                            </select>

                            <button type="submit" class="btn btn-sp-purple btn-sm py-1 px-2.5 rounded-3 fw-bold" style="background-color: #5E2CB5; color: #white; border: none; font-size: 0.8rem;">
                                Simpan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5 text-muted">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
