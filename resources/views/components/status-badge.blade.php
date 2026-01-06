@props(['status'])

@php
    $badges = [
        'pending' => ['class' => 'badge-warning', 'icon' => '⏳'],
        'verified' => ['class' => 'badge-success', 'icon' => '✅'],
        'rejected' => ['class' => 'badge-error', 'icon' => '❌'],
        'accepted' => ['class' => 'badge-info', 'icon' => '🎉'],
    ];

    $badge = $badges[$status] ?? ['class' => 'badge-ghost', 'icon' => ''];
@endphp

<span class="badge {{ $badge['class'] }}">
    {{ $badge['icon'] }} {{ ucfirst($status) }}
</span>
