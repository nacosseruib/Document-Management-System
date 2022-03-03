$('.categoryBonus').on('change', function() {
    var getCategory = $('#category').val();

    if(getCategory == 1)
    {
        $('input[name=comprehensiveInsurance]').prop('checked', true);
        $('input[name=vehiclePlateNumber]').prop('checked', true);
        $('input[name=vehickeTracker]').prop('checked', true);
        $('input[name=fireExtinguisher]').prop('checked', true);
        $('input[name=sixMonthsWarranty]').prop('checked', true);
        $('input[name=threeMonthsServicing]').prop('checked', true);
    }else if(getCategory == 2)
    {
        $('input[name=comprehensiveInsurance]').prop('checked', true);
        $('input[name=vehiclePlateNumber]').prop('checked', true);
        $('input[name=vehickeTracker]').prop('checked', true);
        $('input[name=fireExtinguisher]').prop('checked', true);
        $('input[name=sixMonthsWarranty]').prop('checked', true);
        $('input[name=threeMonthsServicing]').prop('checked', true);
    }else if(getCategory == 3)
    {
        $('input[name=comprehensiveInsurance]').prop('checked', true);
        $('input[name=vehiclePlateNumber]').prop('checked', true);
        $('input[name=vehickeTracker]').prop('checked', true);
        $('input[name=fireExtinguisher]').prop('checked', true);
        $('input[name=sixMonthsWarranty]').prop('checked', true);
        $('input[name=threeMonthsServicing]').prop('checked', true);
    }else{
        $('input[name=comprehensiveInsurance]').prop('checked', false);
        $('input[name=vehiclePlateNumber]').prop('checked', false);
        $('input[name=vehickeTracker]').prop('checked', false);
        $('input[name=fireExtinguisher]').prop('checked', false);
        $('input[name=sixMonthsWarranty]').prop('checked', false);
        $('input[name=threeMonthsServicing]').prop('checked', false);
    }

});
