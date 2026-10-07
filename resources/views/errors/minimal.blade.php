<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('code') - {{ config('app.name', 'Aplikasi') }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #1e293b;
            background: linear-gradient(135deg, #fff7ed 0%, #f8fafc 48%, #fee2e2 100%);
        }
        .backdrop {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background: rgba(15, 23, 42, .2);
            backdrop-filter: blur(8px);
        }
        .dialog {
            width: min(100%, 460px);
            overflow: hidden;
            border: 1px solid #fee2e2;
            border-radius: 28px;
            background: #fff;
            box-shadow: 0 30px 80px rgba(15, 23, 42, .24);
        }
        .accent { height: 7px; background: #dc2626; }
        .content { padding: 32px; }
        .icon {
            display: grid;
            width: 58px;
            height: 58px;
            place-items: center;
            border-radius: 18px;
            color: #dc2626;
            background: #fee2e2;
            font-size: 30px;
            font-weight: 800;
        }
        .code { margin: 22px 0 0; color: #dc2626; font-size: 13px; font-weight: 800; letter-spacing: .14em; }
        h1 { margin: 8px 0 0; color: #0f172a; font-size: 25px; line-height: 1.25; }
        p { margin: 12px 0 0; color: #64748b; font-size: 15px; line-height: 1.7; }
        .actions { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 28px; }
        .button {
            display: inline-flex;
            min-height: 46px;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 14px;
            padding: 11px 16px;
            font: inherit;
            font-size: 14px;
            font-weight: 750;
            text-decoration: none;
            cursor: pointer;
        }
        .button-primary { color: #fff; background: #dc2626; }
        .button-secondary { color: #334155; background: #f1f5f9; }
        .button:focus { outline: 4px solid #fecaca; outline-offset: 2px; }
        @media (max-width: 480px) {
            .content { padding: 26px; }
            .actions { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <main class="backdrop">
        <section class="dialog" role="alertdialog" aria-modal="true" aria-labelledby="error-title">
            <div class="accent"></div>
            <div class="content">
                <div class="icon" aria-hidden="true">!</div>
                <div class="code">ERROR @yield('code')</div>
                <h1 id="error-title">@yield('title')</h1>
                <p>@yield('message')</p>

                <div class="actions">
                    <button class="button button-secondary" type="button" onclick="history.back()">Kembali</button>
                    <a class="button button-primary" href="{{ url('/') }}">Ke beranda</a>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
