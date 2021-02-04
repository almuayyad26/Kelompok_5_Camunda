package service.tasks;

import com.camunda.Minio;
import org.camunda.bpm.engine.delegate.DelegateExecution;
import org.camunda.bpm.engine.delegate.JavaDelegate;

public class SimpanBukti implements JavaDelegate {
    @Override
    public void execute(DelegateExecution delegateExecution) throws Exception {
        Minio minio = new Minio("bukti-transaksi-"+delegateExecution.getBusinessKey()+"-"+delegateExecution.getVariable("nama"));
    }
}
