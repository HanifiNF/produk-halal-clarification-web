@props(['href'])

<style>
    .auth-btn {
        background-color: transparent;
        border: 2px solid #ffffff;
        color: #ffffff;
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.25s ease, border-color 0.25s ease, color 0.25s ease;
        text-decoration: none;
    }

    .auth-btn:hover {
        background-color: #0046b8;
        /* blue-500 */
        border-color: transparent;
        color: #ffffff;
    }
</style>

<a href="{{ $href }}" class="auth-btn">
    {{ $slot }}
</a>