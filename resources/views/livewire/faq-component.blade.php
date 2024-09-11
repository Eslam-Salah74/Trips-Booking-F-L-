<main>
    <div class="modal applyLoanModal fade" id="applyLoan" tabindex="-1" aria-labelledby="applyLoanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
              <h4 class="modal-title" id="exampleModalLabel">How much do you need?</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="#!" method="post">
                <div class="row">
                  <div class="col-lg-6 mb-4 pb-2">
                    <div class="form-group">
                      <label for="loan_amount" class="form-label">Amount</label>
                      <input type="number" class="form-control shadow-none" id="loan_amount" placeholder="ex: 25000">
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4 pb-2">
                    <div class="form-group">
                      <label for="loan_how_long_for" class="form-label">How long for?</label>
                      <input type="number" class="form-control shadow-none" id="loan_how_long_for" placeholder="ex: 12">
                    </div>
                  </div>
                  <div class="col-lg-12 mb-4 pb-2">
                    <div class="form-group">
                      <label for="loan_repayment" class="form-label">Repayment</label>
                      <input type="number" class="form-control shadow-none" id="loan_repayment" disabled>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4 pb-2">
                    <div class="form-group">
                      <label for="loan_full_name" class="form-label">Full Name</label>
                      <input type="text" class="form-control shadow-none" id="loan_full_name">
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4 pb-2">
                    <div class="form-group">
                      <label for="loan_email_address" class="form-label">Email address</label>
                      <input type="email" class="form-control shadow-none" id="loan_email_address">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary w-100">Get Your Loan Now</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <section class="section">
        <div class="container">
          <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
              <div class="section-title text-center">
                <p class="text-primary text-uppercase fw-bold mb-3">Frequient Questions</p>
                <h1>Frequently Asked Questions</h1>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion accordion-border-bottom" id="accordionFAQ">
                    @if ($faqs->isNotEmpty())
                        @foreach ($faqs as $index => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $index }}" aria-expanded="true"
                                        aria-controls="collapse{{ $index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionFAQ">
                                    <div class="accordion-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No Questions found.</p>
                    @endif
        
                    <!-- Display pagination buttons -->
                    <div class="mt-5 pagination-wrapper">
                        {{ $faqs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        
        </div>
      </section>
</dmainiv>
