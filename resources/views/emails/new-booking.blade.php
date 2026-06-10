<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - {{ $booking->booking_reference }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 0;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #F96D00 0%, #d45a00 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .booking-reference {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 25px;
        }
        .booking-reference h3 {
            margin: 0 0 5px;
            color: #666;
            font-size: 14px;
        }
        .booking-reference .reference {
            font-size: 24px;
            font-weight: bold;
            color: #F96D00;
            letter-spacing: 2px;
        }
        .section {
            margin-bottom: 25px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #F96D00;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-label {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }
        .price-summary {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }
        .price-row.total {
            border-top: 2px solid #e0e0e0;
            margin-top: 10px;
            padding-top: 15px;
            font-weight: bold;
            font-size: 18px;
            color: #F96D00;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-confirmed { background-color: #d4edda; color: #155724; }
        .status-ongoing { background-color: #cce5ff; color: #004085; }
        .status-completed { background-color: #d1ecf1; color: #0c5460; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
        .button {
            display: inline-block;
            background-color: #F96D00;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #d45a00;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .social-links {
            margin-top: 15px;
        }
        .social-links a {
            color: #F96D00;
            text-decoration: none;
            margin: 0 10px;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>New Booking Received! 🎉</h1>

        </div>

        <!-- Content -->
        <div class="content">
            <!-- Booking Reference -->
            <div class="booking-reference">
                <h3>Booking Reference Number</h3>
                <div class="reference">{{ $booking->booking_reference }}</div>
                <p style="margin: 10px 0 0; font-size: 12px;">Use this reference to manage your booking</p>
            </div>

            <!-- Booking Status -->
            <div class="section">
                <div class="section-title">
                    📋 Booking Status
                </div>
                <div>
                    <span class="status-badge status-{{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                    <p style="margin-top: 10px; font-size: 14px;">
                        @if($booking->status == 'pending')
                            Booking is pending review. Please review the details and confirm the booking to proceed.
                        @elseif($booking->status == 'confirmed')
                            Booking is confirmed. Waiting for further instructions.
                        @endif
                    </p>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="section">
                <div class="section-title">
                    👤 Customer Information
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $booking->full_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ $booking->email }}</div>
                    </div>
                    @if($booking->phone)
                    <div class="info-item">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value">{{ $booking->phone }}</div>
                    </div>
                    @endif
                    <div class="info-item">
                        <div class="info-label">Booking Date</div>
                        <div class="info-value">{{ $booking->created_at->format('F d, Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Booking Details based on type -->
            @if($booking->booking_type == 'tour')
            <div class="section">
                <div class="section-title">
                    🏔️ Tour Details
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Tour Name</div>
                        <div class="info-value">{{ $item ? $item->name : 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Location</div>
                        <div class="info-value">{{ $item ? $item->location : 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Start Date</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($booking->start_date)->format('F d, Y') }}</div>
                    </div>
                    @if($booking->end_date)
                    <div class="info-item">
                        <div class="info-label">End Date</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($booking->end_date)->format('F d, Y') }}</div>
                    </div>
                    @endif
                    @if($booking->pickup_location)
                    <div class="info-item">
                        <div class="info-label">Pickup Location</div>
                        <div class="info-value">{{ $booking->pickup_location }}</div>
                    </div>
                    @endif
                </div>
            </div>

            @elseif($booking->booking_type == 'package')
            <div class="section">
                <div class="section-title">
                    🎁 Package Details
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Package Name</div>
                        <div class="info-value">{{ $item ? $item->title : 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Duration</div>
                        <div class="info-value">{{ $item ? $item->duration_days : 'N/A' }} days</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Start Date</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($booking->start_date)->format('F d, Y') }}</div>
                    </div>
                    @if($booking->end_date)
                    <div class="info-item">
                        <div class="info-label">End Date</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($booking->end_date)->format('F d, Y') }}</div>
                    </div>
                    @endif
                </div>
                @if($item && $item->inclusions)
                <div style="margin-top: 15px;">
                    <div class="info-label">What's Included</div>
                    <ul style="margin-top: 5px; padding-left: 20px;">
                        @foreach(explode(',', $item->inclusions) as $inclusion)
                            <li style="font-size: 14px;">{{ trim($inclusion) }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            @elseif($booking->booking_type == 'car')
            <div class="section">
                <div class="section-title">
                    🚗 Car Rental Details
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Pickup Location</div>
                        <div class="info-value">{{ $booking->pickup_location }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Destination</div>
                        <div class="info-value">{{ $booking->destination }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Pickup Date</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($booking->start_date)->format('F d, Y') }}</div>
                    </div>
                    @if($booking->end_date)
                    <div class="info-item">
                        <div class="info-label">Return Date</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($booking->end_date)->format('F d, Y') }}</div>
                    </div>
                    @endif
                    <div class="info-item">
                        <div class="info-label">Vehicle Type</div>
                        <div class="info-value">{{ ucfirst($booking->vehicle_type ?? 'Standard') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Passengers</div>
                        <div class="info-value">{{ $booking->num_passengers ?? $booking->num_adults + $booking->num_children }}</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Travelers Information -->
            <div class="section">
                <div class="section-title">
                    👥 Travelers Information
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Number of Adults</div>
                        <div class="info-value">{{ $booking->num_adults }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Number of Children</div>
                        <div class="info-value">{{ $booking->num_children }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Total Travelers</div>
                        <div class="info-value">{{ $booking->num_adults + $booking->num_children }}</div>
                    </div>
                </div>
            </div>

            <!-- Special Requests -->
            @if($booking->special_requests)
            <div class="section">
                <div class="section-title">
                    📝 Special Requests
                </div>
                <p style="margin: 0; background-color: #f9f9f9; padding: 15px; border-radius: 8px;">
                    {{ $booking->special_requests }}
                </p>
            </div>
            @endif



            <!-- Important Information -->
            <div class="section">
                <div class="section-title">
                    ℹ️ Important Information
                </div>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Contact customer service via email {{ $booking->email }} for arrangements</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            {{-- <div style="text-align: center;">
                <a href="{{ route('user.booking.view', $booking->booking_reference) }}" class="button">
                    View Booking Details
                </a>
                <br>
                <a href="{{ route('user.booking.my-bookings') }}" style="display: inline-block; margin-top: 15px; color: #F96D00; text-decoration: none;">
                    View All My Bookings →
                </a>
            </div> --}}
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Ngey Tours & Travel</strong></p>
            <p>Your trusted partner for unforgettable adventures in Tanzania</p>
            <p>
                <a href="https://wa.me/255718940807" target="_blank" >Chat with us on WhatsApp</a> <br>
                <a href="tel:+255 718 940 807">📞 +255 718 940 807</a><br>
                ✉️ ngeytour@gmail.com<br>
                🌐 www.ngeytours.com
            </p>
            <div class="social-links">
                <a href="https://www.facebook.com/profile.php?id=61579176561192">Facebook</a> |
                <a href="https://www.instagram.com/ngeytour/">Instagram</a> |
                <a href="https://www.tiktok.com/@ngeytour?is_from_webapp=1&sender_device=pc">TikTok</a>
            </div>
            <p style="margin-top: 20px; font-size: 11px;">
                This is an automated confirmation email. Please do not reply directly to this message.
            </p>
        </div>
    </div>
</body>
</html>
