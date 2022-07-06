<style>
  .noselect {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .dropdown-container,
  .instructions {
    width: 200px;
    margin: 20px auto 0;
    font-size: 14px;
    font-family: sans-serif;
    overflow: auto;
  }

  .instructions {
    width: 100%;
    text-align: center;
  }

  .dropdown-button {
    float: left;
    width: 100%;
    background: whitesmoke;
    padding: 10px 12px;

    cursor: pointer;
    border: 1px solid lightgray;
    box-sizing: border-box;

    .dropdown-label,
    .dropdown-quantity {
      float: left;
    }

    .dropdown-quantity {
      margin-left: 4px;
    }

    .fa-filter {
      float: right;
    }
  }

  .dropdown-list {
    float: left;
    width: 100%;

    border: 1px solid lightgray;
    border-top: none;
    box-sizing: border-box;
    padding: 10px 12px;

    input[type="search"] {
      padding: 5px 0;
    }

    ul {
      margin: 10px 0;
      max-height: 200px;
      overflow-y: auto;

      input[type="checkbox"] {
        position: relative;
        top: 2px;
      }
    }
  }
</style>
<div class="p-4 bg-light">
  <form action="/add_conference" method="POST">
    <div class="row">
      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Title</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        div class="instructions">(Click to expand and select states to filter)</div>
      <div class="dropdown-container">
        <div class="dropdown-button noselect">
          <div class="dropdown-label">States</div>
          <div class="dropdown-quantity">(<span class="quantity">Any</span>)</div>
          <i class="fa fa-filter"></i>
        </div>
        <div class="dropdown-list" style="display: none;">
          <input type="search" placeholder="Search states" class="dropdown-search" />
          <ul></ul>
        </div>
      </div>
    </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="input-group input-group-outline is-valid my-3">
      <label class="form-label">Success</label>
      <input type="email" class="form-control">
    </div>
  </div>
  <div class="col-md-6">
    <div class="input-group input-group-outline is-invalid my-3">
      <label class="form-label">Error</label>
      <input type="email" class="form-control">
    </div>
  </div>
</div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $('.dropdown-container')
    .on('click', '.dropdown-button', function() {
      $(this).siblings('.dropdown-list').toggle();
    })
    .on('input', '.dropdown-search', function() {
      var target = $(this);
      var dropdownList = target.closest('.dropdown-list');
      var search = target.val().toLowerCase();

      if (!search) {
        dropdownList.find('li').show();
        return false;
      }

      dropdownList.find('li').each(function() {
        var text = $(this).text().toLowerCase();
        var match = text.indexOf(search) > -1;
        $(this).toggle(match);
      });
    })
    .on('change', '[type="checkbox"]', function() {
      var container = $(this).closest('.dropdown-container');
      var numChecked = container.find('[type="checkbox"]:checked').length;
      container.find('.quantity').text(numChecked || 'Any');
    });

  // JSON of States for demo purposes
  var usStates = [{
      name: 'ALABAMA',
      abbreviation: 'AL'
    },
    {
      name: 'ALASKA',
      abbreviation: 'AK'
    },
    {
      name: 'AMERICAN SAMOA',
      abbreviation: 'AS'
    },
    {
      name: 'ARIZONA',
      abbreviation: 'AZ'
    },
    {
      name: 'ARKANSAS',
      abbreviation: 'AR'
    },
    {
      name: 'CALIFORNIA',
      abbreviation: 'CA'
    },
    {
      name: 'COLORADO',
      abbreviation: 'CO'
    },
    {
      name: 'CONNECTICUT',
      abbreviation: 'CT'
    },
    {
      name: 'DELAWARE',
      abbreviation: 'DE'
    },
    {
      name: 'DISTRICT OF COLUMBIA',
      abbreviation: 'DC'
    },
    {
      name: 'FEDERATED STATES OF MICRONESIA',
      abbreviation: 'FM'
    },
    {
      name: 'FLORIDA',
      abbreviation: 'FL'
    },
    {
      name: 'GEORGIA',
      abbreviation: 'GA'
    },
    {
      name: 'GUAM',
      abbreviation: 'GU'
    },
    {
      name: 'HAWAII',
      abbreviation: 'HI'
    },
    {
      name: 'IDAHO',
      abbreviation: 'ID'
    },
    {
      name: 'ILLINOIS',
      abbreviation: 'IL'
    },
    {
      name: 'INDIANA',
      abbreviation: 'IN'
    },
    {
      name: 'IOWA',
      abbreviation: 'IA'
    },
    {
      name: 'KANSAS',
      abbreviation: 'KS'
    },
    {
      name: 'KENTUCKY',
      abbreviation: 'KY'
    },
    {
      name: 'LOUISIANA',
      abbreviation: 'LA'
    },
    {
      name: 'MAINE',
      abbreviation: 'ME'
    },
    {
      name: 'MARSHALL ISLANDS',
      abbreviation: 'MH'
    },
    {
      name: 'MARYLAND',
      abbreviation: 'MD'
    },
    {
      name: 'MASSACHUSETTS',
      abbreviation: 'MA'
    },
    {
      name: 'MICHIGAN',
      abbreviation: 'MI'
    },
    {
      name: 'MINNESOTA',
      abbreviation: 'MN'
    },
    {
      name: 'MISSISSIPPI',
      abbreviation: 'MS'
    },
    {
      name: 'MISSOURI',
      abbreviation: 'MO'
    },
    {
      name: 'MONTANA',
      abbreviation: 'MT'
    },
    {
      name: 'NEBRASKA',
      abbreviation: 'NE'
    },
    {
      name: 'NEVADA',
      abbreviation: 'NV'
    },
    {
      name: 'NEW HAMPSHIRE',
      abbreviation: 'NH'
    },
    {
      name: 'NEW JERSEY',
      abbreviation: 'NJ'
    },
    {
      name: 'NEW MEXICO',
      abbreviation: 'NM'
    },
    {
      name: 'NEW YORK',
      abbreviation: 'NY'
    },
    {
      name: 'NORTH CAROLINA',
      abbreviation: 'NC'
    },
    {
      name: 'NORTH DAKOTA',
      abbreviation: 'ND'
    },
    {
      name: 'NORTHERN MARIANA ISLANDS',
      abbreviation: 'MP'
    },
    {
      name: 'OHIO',
      abbreviation: 'OH'
    },
    {
      name: 'OKLAHOMA',
      abbreviation: 'OK'
    },
    {
      name: 'OREGON',
      abbreviation: 'OR'
    },
    {
      name: 'PALAU',
      abbreviation: 'PW'
    },
    {
      name: 'PENNSYLVANIA',
      abbreviation: 'PA'
    },
    {
      name: 'PUERTO RICO',
      abbreviation: 'PR'
    },
    {
      name: 'RHODE ISLAND',
      abbreviation: 'RI'
    },
    {
      name: 'SOUTH CAROLINA',
      abbreviation: 'SC'
    },
    {
      name: 'SOUTH DAKOTA',
      abbreviation: 'SD'
    },
    {
      name: 'TENNESSEE',
      abbreviation: 'TN'
    },
    {
      name: 'TEXAS',
      abbreviation: 'TX'
    },
    {
      name: 'UTAH',
      abbreviation: 'UT'
    },
    {
      name: 'VERMONT',
      abbreviation: 'VT'
    },
    {
      name: 'VIRGIN ISLANDS',
      abbreviation: 'VI'
    },
    {
      name: 'VIRGINIA',
      abbreviation: 'VA'
    },
    {
      name: 'WASHINGTON',
      abbreviation: 'WA'
    },
    {
      name: 'WEST VIRGINIA',
      abbreviation: 'WV'
    },
    {
      name: 'WISCONSIN',
      abbreviation: 'WI'
    },
    {
      name: 'WYOMING',
      abbreviation: 'WY'
    }
  ];

  // <li> template
  var stateTemplate = _.template(
    '<li>' +
    '<input name="<%= abbreviation %>" type="checkbox">' +
    '<label for="<%= abbreviation %>"><%= capName %></label>' +
    '</li>'
  );

  // Populate list with states
  _.each(usStates, function(s) {
    s.capName = _.startCase(s.name.toLowerCase());
    $('ul').append(stateTemplate(s));
  });
</script>