{{-- FAQ Section --}}
<section id="faq" class="py-20 relative">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        {{-- Section Header --}}
        <div class="text-center mb-14">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-neon-cyan/60 mb-3">Need Help?</p>
            <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white heading-accent">
                Frequently Asked Questions
            </h2>
        </div>

        {{-- FAQ Items --}}
        <div class="space-y-2">
            @include('components.faq-item', [
                'question' => 'Who can participate in DIGIon 2026?',
                'answer' => 'DIGIon is open to all active high school students (SMA/SMK/MA) across Indonesia. Participants must be currently enrolled and able to provide a valid student card as proof of enrollment.',
            ])

            @include('components.faq-item', [
                'question' => 'Can I register as an individual or must I form a team?',
                'answer' => 'DIGIon is a team-based competition. For Data Analytics, teams must have 2–3 members. For Tech Rally Games, each team must have exactly 3 members. All team members must be from the same school.',
            ])

            @include('components.faq-item', [
                'question' => 'Is there a registration fee?',
                'answer' => 'Yes, there is a registration fee of Rp 150.000 per team. Payment is made via QRIS during the registration process. The fee covers all competition stages including access to workshops and materials.',
            ])

            @include('components.faq-item', [
                'question' => 'What documents are required for registration?',
                'answer' => 'Each team member must upload a valid Student Card (PDF). The team must also upload Twibbon Proof (PDF) showing social media participation, and a Payment Proof image. All documents must be clear and legible.',
            ])

            @include('components.faq-item', [
                'question' => 'How many teams can be accepted?',
                'answer' => 'Each competition category accepts a maximum of 24 approved teams. Registrations beyond this limit will be placed on a waiting list and may be promoted if a slot opens up.',
            ])

            @include('components.faq-item', [
                'question' => 'What happens if my team is on the waiting list?',
                'answer' => 'Teams on the waiting list are automatically promoted when a slot becomes available (e.g., if an approved team is rejected or withdraws). You will be notified via email and WhatsApp if your team is promoted.',
            ])

            @include('components.faq-item', [
                'question' => 'Can I track my registration status?',
                'answer' => 'Yes! After registering, you will receive a unique registration code (e.g., DGN-2026-0042). Use this code on the Status Tracking page to check your team\'s current status at any time.',
            ])
        </div>
    </div>
</section>
