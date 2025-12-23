@props(['type' => 'submit'])

<style>
    .form-btn {
        background-color: transparent;
        border: 2px solid #ffffff;
        color: #ffffff;
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        /* text-xs */
        letter-spacing: 0.05em;
        /* tracking-widest */
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.25s ease, border-color 0.25s ease, color 0.25s ease, transform 0.2s ease;
    }

    .form-btn:hover {
        background-color: #3b82f6;
        /* Tailwind blue-500 */
        border-color: transparent;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .form-btn:active {
        background-color: #2563eb;
        /* blue-600 */
        transform: translateY(0);
    }

    .form-btn:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        /* blue ring */
    }
</style>

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'form-btn']) }}>
    {{ $slot }}
</button>