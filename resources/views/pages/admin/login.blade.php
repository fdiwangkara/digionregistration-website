<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — DIGIon 2026</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cyber-dark text-white font-sans antialiased min-h-screen flex items-center justify-center cyber-grid">
    <div class="w-full max-w-sm mx-auto px-4">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <h1 class="font-display text-2xl font-bold tracking-wider">
                <span class="text-neon-cyan">DIGI</span><span class="text-neon-pink">on</span>
            </h1>
            <p class="text-xs text-white/30 mt-1">Admin Panel</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-cyber-dark/80 border border-white/10 rounded-lg p-6">
            <h2 class="text-sm font-semibold text-white/70 mb-5">Sign in to continue</h2>

            @if($errors->any())
            <div class="mb-4 p-3 rounded border border-red-500/20 bg-red-500/5 text-xs text-red-400">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-3 rounded border border-red-500/20 bg-red-500/5 text-xs text-red-400">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-xs text-white/40 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-white/[0.03] border border-white/10 rounded px-3 py-2.5 text-sm text-white placeholder-white/15 focus:border-neon-cyan/50 transition-colors"
                           placeholder="admin@digion.id">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-xs text-white/40 mb-1.5">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full bg-white/[0.03] border border-white/10 rounded px-3 py-2.5 text-sm text-white placeholder-white/15 focus:border-neon-cyan/50 transition-colors"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between mb-5">
                    <label class="flex items-center gap-2 text-xs text-white/30 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/5 text-neon-cyan focus:ring-neon-cyan/50">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="w-full py-2.5 text-sm rounded btn-primary">
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-white/15 mt-6">
            <a href="{{ route('landing') }}" class="hover:text-white/40 transition-colors">← Back to site</a>
        </p>
    </div>
</body>
</html>
