<style>
    :root {
        --primary: #0d1b3d;
        --accent: #f4b400;
        --muted: #6c7a91;
    }
    body {
        background: #eef1f5;
        font-family: 'Figtree', sans-serif;
    }
    .app-shell { min-height: 100vh; }
    .main-content { flex: 1; min-width: 0; padding: 1.5rem; }
    .top-nav { width: 100%; position: sticky; top: 0; z-index: 3; }
    .sidebar {
        width: 220px;
        min-height: 100vh;
        background: var(--primary);
        color: #cfd6e4;
        position: sticky;
        top: 0;
        box-shadow: 8px 0 24px rgba(0,0,0,0.08);
    }
    .sidebar .nav-link {
        color: #cfd6e4;
        border-radius: 10px;
        padding: 0.65rem 0.85rem;
    }
    .sidebar .nav-link:hover, .sidebar .nav-link.active {
        background: rgba(255,255,255,0.12);
        color: #fff;
    }
    .card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    }
    .chart-wrapper {
        border: 1px solid #e5e8ef;
        border-radius: 12px;
        padding: 1rem 1.25rem 0.5rem;
    }
    .chart-grid {
        display: flex;
        align-items: flex-end;
        gap: 14px;
        height: 220px;
        position: relative;
    }
    .chart-grid::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 1px;
        background: #cfd3dc;
    }
    .chart-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        width: 30px;
    }
    .bar-primary {
        width: 100%;
        border-radius: 10px;
        background: linear-gradient(180deg, #5a74ff, #3348d4);
    }
    .bar-accent {
        width: 100%;
        border-radius: 10px;
        background: linear-gradient(180deg, #ffd960, var(--accent));
    }
    .latest-card { border: 1px solid #e8ecf2; border-radius: 12px; }
    .latest-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e6e9ef;
    }
    @media (max-width: 991px) {
        .app-shell { flex-direction: column; }
        .sidebar {
            width: 100%;
            min-height: auto;
            position: relative;
            box-shadow: none;
        }
        .main-content { padding: 1rem; }
    }
</style>
