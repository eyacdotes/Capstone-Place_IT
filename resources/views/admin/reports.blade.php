<title>Admin Reports</title>
<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Admin Reports</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Approved Negotiations Report Card -->
            <div class="col">
                <div class="card shadow-lg border-light rounded h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title font-weight-bold">Approved Negotiations</h5>
                        <p class="card-text text-muted">Total approved negotiations.</p>
                        <a href="{{ route('admin.negotiations', ['status' => 'approved']) }}" class="btn btn-outline-primary">
                            {{ $approvedNegotiations }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pending Negotiations Report Card -->
            <div class="col">
                <div class="card shadow-lg border-light rounded h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-clock fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title font-weight-bold">Pending Negotiations</h5>
                        <p class="card-text text-muted">Total pending negotiations.</p>
                        <a href="{{ route('admin.negotiations', ['status' => 'pending']) }}" class="btn btn-outline-warning">
                            {{ $pendingNegotiations }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Negotiations Report Card -->
            <div class="col">
                <div class="card shadow-lg border-light rounded h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-comments fa-3x mb-3 text-info"></i>
                        <h5 class="card-title font-weight-bold">Total Negotiations</h5>
                        <p class="card-text text-muted">Total number of all negotiations.</p>
                        <p class="card-text text-muted">{{ $totalNegotiations }}</p>
                        <a href="{{ route('admin.negotiations') }}" class="btn btn-outline-info">
                            View Details
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Feedback Report Card -->
            <div class="col">
                <div class="card shadow-lg border-light rounded h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-comments-dollar fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title font-weight-bold">System Feedbacks</h5>
                        <p class="card-text text-muted">Total system feedbacks received.</p>
                        <p class="card-text text-muted">{{ $systemFeedbacks }}</p>
                        <a href="{{ route('admin.feedbacks') }}" class="btn btn-outline-danger">
                            View Detail
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reviews Report Card -->
            <div class="col">
                <div class="card shadow-lg border-light rounded h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-star fa-3x mb-3 text-info"></i>
                        <h5 class="card-title font-weight-bold">Reviews</h5>
                        <p class="card-text text-muted">Total reviews on rental agreements.</p>
                        <p class="card-text text-muted">{{ $reviews }}</p>
                        <a href="{{ route('admin.reviews') }}" class="btn btn-outline-info">
                            View Detail
                        </a>
                    </div>
                </div>
            </div>

            <!-- Payment History Report Card -->
            <div class="col">
                <div class="card shadow-lg border-light rounded h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-credit-card fa-3x mb-3 text-secondary"></i>
                        <h5 class="card-title font-weight-bold">Payment History</h5>
                        <p class="card-text text-muted">Total payments made.</p>
                        <a href="{{ route('admin.payments') }}" class="btn btn-outline-secondary">
                            {{ $paymentHistory }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Earnings Report Card -->
            <div class="col">
                <div class="card shadow-lg border-light rounded h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-wallet fa-3x mb-3 text-success"></i>
                        <h5 class="card-title font-weight-bold">Total Earnings</h5>
                        <p class="card-text text-muted">Total earnings 10% of each negotiations.</p>
                        <a href="#" class="btn btn-outline-success">
                            ₱{{ number_format($totalEarnings, 2) }}
                        </a>
                    </div>
                </div>
            </div>
            <button onclick="printReport()" class="btn btn-primary mt-3">Print Report</button>
        </div>
    </div>
    <script>
        function printReport() {
            window.print();
        }
    </script>
</x-app-layout>
