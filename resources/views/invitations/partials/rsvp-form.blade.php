<!-- RSVP Form Section -->
<div class="bg-gray-50 rounded-lg p-6">
    <h3 class="text-2xl font-bold text-gray-800 mb-6">Quick RSVP</h3>

    @include('invitations.partials.guest-rsvp', ['wedding' => $wedding])

    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
        <p class="text-sm text-blue-800">
            <strong>Need help?</strong> Each guest has a unique invitation link to submit their RSVP.
        </p>
    </div>
</div>
