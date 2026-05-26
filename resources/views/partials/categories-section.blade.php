{{-- Competition Categories Section --}}
<section id="competitions" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        {{-- Section Header --}}
        <div class="text-center mb-14">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-neon-cyan/60 mb-3">Choose Your Path</p>
            <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white heading-accent">
                Competition Categories
            </h2>
        </div>

        {{-- Cards Grid --}}
        <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            @include('components.competition-card', ['competition' => (object)[
                'slug' => 'data-analytics',
                'title' => 'Data Analytics Competition',
                'icon' => 'fa-solid fa-chart-bar',
                'description' => 'Master real-world datasets, perform data cleaning and analysis, discover insights, and present compelling data-driven solutions to real problems.',
                'team_size' => '2–3 Members',
                'timeline' => 'May – August 2026',
                'color' => 'cyan',
                'hashtag' => '#SmartWithData',
            ]])

            @include('components.competition-card', ['competition' => (object)[
                'slug' => 'tech-rally',
                'title' => 'Tech Rally Games',
                'icon' => 'fa-solid fa-puzzle-piece',
                'description' => 'Race against time through technology puzzles, coding challenges, and hands-on missions. Test your team\'s speed, logic, and technical expertise.',
                'team_size' => 'Exactly 3 Members',
                'timeline' => 'May – August 2026',
                'color' => 'pink',
                'hashtag' => '#BuildTheFuture',
            ]])
        </div>
    </div>
</section>
