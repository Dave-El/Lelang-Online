// Abstract class representing a bank account
abstract class BankAccount {
    protected $accountNumber;
    protected $balance;

    public function __construct($accountNumber, $balance = 0) {
        $this->accountNumber = $accountNumber;
        $this->balance = $balance;
    }

    public function getAccountNumber() {
        return $this->accountNumber;
    }

    public function getBalance() {
        return $this->balance;
    }

    abstract public function deposit($amount);
    abstract public function withdraw($amount);
}

// Savings account class extending the BankAccount class
class SavingsAccount extends BankAccount {
    private $interestRate;

    public function __construct($accountNumber, $balance = 0, $interestRate) {
        parent::__construct($accountNumber, $balance);
        $this->interestRate = $interestRate;
    }

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
        } else {
            echo "Insufficient balance.<br>";
        }
    }

    public function calculateInterest() {
        $interest = $this->balance * $this->interestRate / 100;
        $this->balance += $interest;
    }
}

// Checking account class extending the BankAccount class
class CheckingAccount extends BankAccount {
    private $transactionFee;

    public function __construct($accountNumber, $balance = 0, $transactionFee) {
        parent::__construct($accountNumber, $balance);
        $this->transactionFee = $transactionFee;
    }

    public function deposit($amount) {
        $this->balance += $amount;
        $this->deductTransactionFee();
    }

    public function withdraw($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            $this->deductTransactionFee();
        } else {
            echo "Insufficient balance.<br>";
        }
    }

    private function deductTransactionFee() {
        $this->balance -= $this->transactionFee;
    }
}

// Polymorphic function to process a bank transaction
function processTransaction(BankAccount $account, $amount) {
    $account->withdraw($amount);
}

// Create savings account object
$savingsAccount = new SavingsAccount("SAV-001", 1000, 2.5);
echo "Savings Account - Account Number: " . $savingsAccount->getAccountNumber() . "<br>";
echo "Initial Balance: $" . $savingsAccount->getBalance() . "<br>";

// Deposit and withdraw from savings account
$savingsAccount->deposit(500);
processTransaction($savingsAccount, 200);
$savingsAccount->calculateInterest();
echo "Final Balance: $" . $savingsAccount->getBalance() . "<br><br>";

// Create checking account object
$checkingAccount = new CheckingAccount("CHK-001", 2000, 2);
echo "Checking Account - Account Number: " . $checkingAccount->getAccountNumber() . "<br>";
echo "Initial Balance: $" . $checkingAccount->getBalance() . "<br>";

// Deposit and withdraw from checking account
$checkingAccount->deposit(100);
processTransaction($checkingAccount, 500);
echo "Final Balance: $" . $checkingAccount->getBalance() . "<br>";
